<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Timezone;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\TimezoneResource\Pages;

class TimezoneResource extends Resource
{
    protected static ?string $model = Timezone::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'zone_name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('zone_name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Zone Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('country_code')
                        ->rules(['max:2', 'string'])
                        ->required()
                        ->placeholder('Country Code')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('abbreviation')
                        ->rules(['max:6', 'string'])
                        ->required()
                        ->placeholder('Abbreviation')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('time_start')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Time Start')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('gmt_offset')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Gmt Offset')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Toggle::make('dst')
                        ->rules(['boolean'])
                        ->required()
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
                Tables\Columns\TextColumn::make('zone_name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('country_code')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('abbreviation')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('time_start')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('gmt_offset')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\IconColumn::make('dst')
                    ->toggleable()
                    ->boolean(),
            ])
            ->filters([DateRangeFilter::make('created_at')])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            TimezoneResource\RelationManagers\CountriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimezones::route('/'),
            'create' => Pages\CreateTimezone::route('/create'),
            'view' => Pages\ViewTimezone::route('/{record}'),
            'edit' => Pages\EditTimezone::route('/{record}/edit'),
        ];
    }
}
