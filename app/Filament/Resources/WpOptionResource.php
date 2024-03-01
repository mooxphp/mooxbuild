<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\WpOption;
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
use App\Filament\Resources\WpOptionResource\Pages;

class WpOptionResource extends Resource
{
    protected static ?string $model = WpOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'option_name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('option_name')
                        ->rules(['max:191', 'string'])
                        ->required()
                        ->placeholder('Option Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('option_value')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Option Value')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('autoload')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Autoload')
                        ->default('20')
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
                Tables\Columns\TextColumn::make('option_name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('option_value')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('autoload')
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
            'index' => Pages\ListWpOptions::route('/'),
            'create' => Pages\CreateWpOption::route('/create'),
            'view' => Pages\ViewWpOption::route('/{record}'),
            'edit' => Pages\EditWpOption::route('/{record}/edit'),
        ];
    }
}
