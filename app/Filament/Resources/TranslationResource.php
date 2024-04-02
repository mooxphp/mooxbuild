<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Translation;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\TranslationResource\Pages;

class TranslationResource extends Resource
{
    protected static ?string $model = Translation::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'id';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('language_id')
                        ->rules(['exists:languages,id'])
                        ->required()
                        ->relationship('language', 'title')
                        ->searchable()
                        ->placeholder('Language')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('fallback_language_id')
                        ->rules(['exists:languages,id'])
                        ->required()
                        ->relationship('fallback_language', 'title')
                        ->searchable()
                        ->placeholder('Fallback Language')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('language.title')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('fallbackLanguage.title')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('language_id')
                    ->relationship('language', 'title')
                    ->indicator('Language')
                    ->multiple()
                    ->label('Language'),

                SelectFilter::make('fallback_language_id')
                    ->relationship('fallback_language', 'title')
                    ->indicator('Language')
                    ->multiple()
                    ->label('Language'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTranslations::route('/'),
            'create' => Pages\CreateTranslation::route('/create'),
            'view' => Pages\ViewTranslation::route('/{record}'),
            'edit' => Pages\EditTranslation::route('/{record}/edit'),
        ];
    }
}
