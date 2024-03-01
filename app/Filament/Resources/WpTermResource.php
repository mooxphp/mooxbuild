<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\WpTerm;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\WpTermResource\Pages;

class WpTermResource extends Resource
{
    protected static ?string $model = WpTerm::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['max:200', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('slug')
                        ->rules(['max:200', 'string'])
                        ->required()
                        ->placeholder('Slug')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('term_group')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Term Group')
                        ->default('0')
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
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('term_group')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
            ])
            ->filters([DateRangeFilter::make('created_at')])
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
            'index' => Pages\ListWpTerms::route('/'),
            'create' => Pages\CreateWpTerm::route('/create'),
            'view' => Pages\ViewWpTerm::route('/{record}'),
            'edit' => Pages\EditWpTerm::route('/{record}/edit'),
        ];
    }
}
