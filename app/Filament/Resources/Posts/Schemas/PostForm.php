<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1 : Post Details
                Section::make('Post Details')
                ->description("Fill in the details of the post")
                ->icon('heroicon-o-document-text')
                ->schema([
                    Group::make([
                        TextInput::make('title')
                            ->minLength(5) // Validasi minimal 5 karakter
                            ->validationMessages([
                                'min' => 'Judul artikel terlalu pendek, minimal harus 5 karakter.', // Custom message 1
                            ]),
                        TextInput::make('slug')
                            ->required()
                            ->minLength(3) // Validasi minimal 3 karakter
                            ->unique(ignoreRecord: true) // Validasi unik yang aman untuk proses edit
                            ->validationMessages([
                                'unique' => 'Slug ini sudah dipakai, silakan gunakan kata kunci lain.', // Custom message 2
                                'min' => 'Slug minimal harus terdiri dari 3 karakter.',
                            ]),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->options(Category::all()->pluck('name', 'id'))
                            // ->preload()
                            ->searchable()
                            ->required(),
                        ColorPicker::make('color'),
                    ])->columns(2),
                    MarkdownEditor::make('content'),
                ])->columnSpan(2),
                // RichEditor::make('content'),

                Group::make([
                    // Section 2 : Image
                    Section::make("Image Upload")
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('posts')
                            ->required(),
                    ]),

                    // Section 3 : Meta \\
                    Section::make("Meta Information")
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        TagsInput::make('tags'),
                        Checkbox::make('published'),
                        DateTimePicker::make('published_at')
                    ]),
                ])->columnSpan(1)
            ])->columns(3);
    }
}
