<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\RelationManagers\RelationManager;

class PagesRelationManager extends RelationManager
{
    protected static string $relationship = 'pages';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('uid')
                    ->rules(['max:255'])
                    ->placeholder('Uid')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('main_category_id')
                    ->rules(['exists:categories,id'])
                    ->relationship('mainCategory', 'title')
                    ->searchable()
                    ->placeholder('Main Category')
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

                TextInput::make('slug')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Slug')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                RichEditor::make('short')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Short')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                RichEditor::make('content')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Content')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                KeyValue::make('data')->columnSpan([
                    'default' => 12,
                    'md' => 12,
                    'lg' => 12,
                ]),

                FileUpload::make('image')
                    ->rules(['image', 'max:1024'])
                    ->image()
                    ->placeholder('Image')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                FileUpload::make('thumbnail')
                    ->rules(['file'])
                    ->image()
                    ->placeholder('Thumbnail')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('author_id')
                    ->rules(['exists:authors,id'])
                    ->relationship('author', 'title')
                    ->searchable()
                    ->placeholder('Author')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('created_by_user_id')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Created By User Id')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('created_by_user_name')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Created By User Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('edited_by_user_id')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Edited By User Id')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('edited_by_user_name')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Edited By User Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                DatePicker::make('published_at')
                    ->rules(['date'])
                    ->placeholder('Published At')
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
                Tables\Columns\TextColumn::make('uid')->limit(50),
                Tables\Columns\TextColumn::make('mainCategory.title')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('title')->limit(50),
                Tables\Columns\TextColumn::make('slug')->limit(50),
                Tables\Columns\TextColumn::make('short')->limit(50),
                Tables\Columns\TextColumn::make('content')->limit(50),
                Tables\Columns\ImageColumn::make('image')->rounded(),
                Tables\Columns\ImageColumn::make('thumbnail')->rounded(),
                Tables\Columns\TextColumn::make('author.title')->limit(50),
                Tables\Columns\TextColumn::make('created_by_user_id')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('created_by_user_name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('edited_by_user_id')->limit(50),
                Tables\Columns\TextColumn::make('edited_by_user_name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('translation.title')->limit(50),
                Tables\Columns\TextColumn::make('published_at')->date(),
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

                SelectFilter::make('main_category_id')
                    ->multiple()
                    ->relationship('mainCategory', 'title'),

                SelectFilter::make('author_id')
                    ->multiple()
                    ->relationship('author', 'title'),

                SelectFilter::make('translation_id')
                    ->multiple()
                    ->relationship('translation', 'title'),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }
}
