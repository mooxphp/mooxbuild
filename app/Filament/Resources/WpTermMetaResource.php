<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\WpTermMeta;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\WpTermMetaResource\Pages;

class WpTermMetaResource extends Resource
{
    protected static ?string $model = WpTermMeta::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'meta_key';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('term_id')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Term Id')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('meta_key')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Meta Key')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('meta_value')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Meta Value')
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
                Tables\Columns\TextColumn::make('term_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('meta_key')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('meta_value')
                    ->toggleable()
                    ->searchable()
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
            'index' => Pages\ListWpTermMetas::route('/'),
            'create' => Pages\CreateWpTermMeta::route('/create'),
            'view' => Pages\ViewWpTermMeta::route('/{record}'),
            'edit' => Pages\EditWpTermMeta::route('/{record}/edit'),
        ];
    }
}
