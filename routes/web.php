<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'QuestionController@index');

Auth::routes();

Route::get('/home', 'QuestionController@index')->name('home');

Route::resource('questions', 'QuestionController', ['except' => 'show']);
Route::resource('questions.answers', 'AnswersController', ['except' => ['index', 'show','create']]);

Route::get('questions/{slug}', 'QuestionController@show')->name('questions.show');

Route::post('answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

Route::post('questions/{question}/favorite', 'FavoriteController@store')->name('questions.favorite');
Route::delete('questions/{question}/favorite', 'FavoriteController@destroy')->name('questions.unfavorite');
Route::post('questions/{question}/vote','VoteQuestionsController')->name('voteQuestions');
Route::post('answers/{answer}/vote','VoteAnswersController')->name('voteAnswers');