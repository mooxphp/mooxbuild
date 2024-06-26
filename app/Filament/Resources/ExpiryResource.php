<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Expiry;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\ExpiryResource\Pages;

class ExpiryResource extends Resource
{
    protected static ?string $model = Expiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('title')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Title')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('slug')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Slug')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('item')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Item')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('link')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Link')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('expired_at')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Expired At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('notified_at')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Notified At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('notified_to')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Notified To')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('escalated_at')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Escalated At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('escalated_to')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Escalated To')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('handled_by')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Handled By')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('done_at')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Done At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('expiry_monitor_id')
                        ->rules(['exists:expiry_monitors,id'])
                        ->required()
                        ->relationship('expiryMonitor', 'title')
                        ->searchable()
                        ->placeholder('Expiry Monitor')
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
                Tables\Columns\TextColumn::make('title')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('slug')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('item')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('link')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('expired_at')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('notified_at')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('notified_to')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('escalated_at')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('escalated_to')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('handled_by')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('done_at')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('expiryMonitor.title')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('expiry_monitor_id')
                    ->relationship('expiryMonitor', 'title')
                    ->indicator('ExpiryMonitor')
                    ->multiple()
                    ->label('ExpiryMonitor'),
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
            'index' => Pages\ListExpiries::route('/'),
            'create' => Pages\CreateExpiry::route('/create'),
            'view' => Pages\ViewExpiry::route('/{record}'),
            'edit' => Pages\EditExpiry::route('/{record}/edit'),
        ];
    }
}
