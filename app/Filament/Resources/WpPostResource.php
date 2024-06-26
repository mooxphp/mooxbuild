<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\WpPost;
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
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\WpPostResource\Pages;

class WpPostResource extends Resource
{
    protected static ?string $model = WpPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'post_title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('post_author')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Post Author')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('post_date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Post Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('post_date_gmt')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Post Date Gmt')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('post_content')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Post Content')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('post_title')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Post Title')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('post_excerpt')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Post Excerpt')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('post_status')
                        ->rules(['max:20', 'string'])
                        ->required()
                        ->placeholder('Post Status')
                        ->default('publish')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('comment_status')
                        ->rules(['max:20', 'string'])
                        ->required()
                        ->placeholder('Comment Status')
                        ->default('open')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('ping_status')
                        ->rules(['max:20', 'string'])
                        ->required()
                        ->placeholder('Ping Status')
                        ->default('open')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('post_password')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Post Password')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('post_name')
                        ->rules(['max:200', 'string'])
                        ->required()
                        ->placeholder('Post Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('to_ping')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('To Ping')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('pinged')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Pinged')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('post_modified')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Post Modified')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('post_modified_gmt')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Post Modified Gmt')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('post_content_filtered')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Post Content Filtered')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('post_parent')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Post Parent')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('guid')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Guid')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('menu_order')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Menu Order')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('post_type')
                        ->rules(['max:20', 'string'])
                        ->required()
                        ->placeholder('Post Type')
                        ->default('post')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('post_mime_type')
                        ->rules(['max:100', 'string'])
                        ->required()
                        ->placeholder('Post Mime Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('comment_count')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Comment Count')
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
                Tables\Columns\TextColumn::make('post_author')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_date')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('post_date_gmt')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('post_content')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_title')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_excerpt')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_status')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('comment_status')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('ping_status')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_password')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('to_ping')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('pinged')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_modified')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('post_modified_gmt')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('post_content_filtered')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_parent')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('guid')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('menu_order')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('post_type')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('post_mime_type')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('comment_count')
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
            'index' => Pages\ListWpPosts::route('/'),
            'create' => Pages\CreateWpPost::route('/create'),
            'view' => Pages\ViewWpPost::route('/{record}'),
            'edit' => Pages\EditWpPost::route('/{record}/edit'),
        ];
    }
}
