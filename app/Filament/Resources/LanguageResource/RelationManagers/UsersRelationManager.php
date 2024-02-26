<?php

namespace App\Filament\Resources\LanguageResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\LanguageResource\Pages;
use Filament\Resources\RelationManagers\RelationManager;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('slug')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Slug')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('gender')
                    ->rules(['in:male,female,other'])
                    ->searchable()
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->placeholder('Gender')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('title')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Title')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('first_name')
                    ->rules(['max:255', 'string'])
                    ->placeholder('First Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('last_name')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Last Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('email')
                    ->rules(['email'])
                    ->unique('users', 'email', fn(?Model $record) => $record)
                    ->email()
                    ->placeholder('Email')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('website')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Website')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                RichEditor::make('description')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Description')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => \Hash::make($state))
                    ->required(
                        fn(Component $livewire) => $livewire instanceof
                            Pages\CreateUser
                    )
                    ->placeholder('Password')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('profile_photo_path')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Profile Photo Path')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('wp_id')
                    ->rules(['max:255'])
                    ->placeholder('Wp Id')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('slug')->limit(50),
                Tables\Columns\TextColumn::make('gender')->enum([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ]),
                Tables\Columns\TextColumn::make('title')->limit(50),
                Tables\Columns\TextColumn::make('first_name')->limit(50),
                Tables\Columns\TextColumn::make('last_name')->limit(50),
                Tables\Columns\TextColumn::make('email')->limit(50),
                Tables\Columns\TextColumn::make('website')->limit(50),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('profile_photo_path')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('wp_id')->limit(50),
                Tables\Columns\TextColumn::make('language.title')->limit(50),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                SelectFilter::make('language_id')
                    ->multiple()
                    ->relationship('language', 'title'),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }
}
