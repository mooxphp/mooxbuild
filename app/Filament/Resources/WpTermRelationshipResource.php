<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\WpTermRelationship;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\WpTermRelationshipResource\Pages;

class WpTermRelationshipResource extends Resource
{
    protected static ?string $model = WpTermRelationship::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'object_id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('term_taxonomy_id')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Term Taxonomy Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('term_order')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Term Order')
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
                Tables\Columns\TextColumn::make('term_taxonomy_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('term_order')
                    ->toggleable()
                    ->searchable(true, null, true),
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
            'index' => Pages\ListWpTermRelationships::route('/'),
            'create' => Pages\CreateWpTermRelationship::route('/create'),
            'view' => Pages\ViewWpTermRelationship::route('/{record}'),
            'edit' => Pages\EditWpTermRelationship::route('/{record}/edit'),
        ];
    }
}
