<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Session;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\SessionResource\Pages;

class SessionResource extends Resource
{
    protected static ?string $model = Session::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'user_agent';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('ip_address')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Ip Address')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('user_agent')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('User Agent')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('payload')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Payload')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('last_activity')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Last Activity')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('user_id')
                        ->rules(['exists:users,id'])
                        ->required()
                        ->relationship('user', 'name')
                        ->searchable()
                        ->placeholder('User')
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
                Tables\Columns\TextColumn::make('ip_address')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('user_agent')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('payload')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('last_activity')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('user.name')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->indicator('User')
                    ->multiple()
                    ->label('User'),
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
            'index' => Pages\ListSessions::route('/'),
            'create' => Pages\CreateSession::route('/create'),
            'view' => Pages\ViewSession::route('/{record}'),
            'edit' => Pages\EditSession::route('/{record}/edit'),
        ];
    }
}
