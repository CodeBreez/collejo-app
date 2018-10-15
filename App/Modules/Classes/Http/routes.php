<?php

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'batches'], function () {
        Route::get('/list', 'BatchController@getBatchList')->name('batches.list');
    });

    Route::group(['prefix' => 'batch'], function () {
        Route::get('/grades', 'BatchController@getBatchGrades')->middleware('ajax')->name('batch.grades.search');

        Route::get('/new', 'BatchController@getBatchNew')->name('batch.new');
        Route::post('/new', 'BatchController@postBatchNew');

        Route::get('/{id}/details/view', 'BatchController@getBatchDetailsView')->name('batch.details.view');
        Route::get('/{id}/details/edit', 'BatchController@getBatchDetailsEdit')->name('batch.details.edit');
        Route::post('/{id}/details/edit', 'BatchController@postBatchDetailsEdit');

        Route::get('/{id}/terms/view', 'BatchController@getBatchTermsView')->name('batch.terms.view');
        Route::get('/{id}/terms/edit', 'BatchController@getBatchTermsEdit')->name('batch.terms.edit');

        Route::get('/{id}/term/new', 'BatchController@getBatchTermNew')->name('batch.term.new');
        Route::post('/{id}/term/new', 'BatchController@postBatchTermNew');

        Route::get('/{id}/term/{tid}/edit', 'BatchController@getBatchTermEdit')->name('batch.term.edit');
        Route::post('/{id}/term/{tid}/edit', 'BatchController@postBatchTermEdit');

        Route::delete('/{id}/term/{tid}/delete', 'BatchController@getBatchTermDelete')->name('batch.term.delete');

        Route::get('/{id}/grades/view', 'BatchController@getBatchGradesView')->name('batch.grades.view');
        Route::get('/{id}/grades/edit', 'BatchController@getBatchGradesEdit')->name('batch.grades.edit');
        Route::post('/{id}/grades/edit', 'BatchController@postBatchGradesEdit');
    });

    Route::group(['prefix' => 'grades'], function () {
        Route::get('/list', 'GradeController@getGradeList')->name('grades.list');
    });

    Route::group(['prefix' => 'grade'], function () {
        Route::get('/new', 'GradeController@getGradeNew')->name('grade.new');
        Route::post('/new', 'GradeController@postGradeNew');

        Route::get('/{id}/details/view', 'GradeController@getGradeDetailsView')->name('grade.details.view');
        Route::get('/{id}/details/edit', 'GradeController@getGradeDetailsEdit')->name('grade.details.edit');
        Route::post('/{id}/details/edit', 'GradeController@postGradeDetailsEdit');

        Route::delete('/{id}/delete', 'GradeController@getDelete')->name('grade.delete');

        Route::get('/{id}/classes/view', 'GradeController@getGradeClassesView')->name('grade.classes.view');
        Route::get('/{id}/classes/edit', 'GradeController@getGradeClassesEdit')->name('grade.classes.edit');

        Route::get('/{id}/class/new', 'GradeController@getGradeClassNew')->name('grade.class.new');
        Route::post('/{id}/class/new', 'GradeController@postGradeClassNew');

        Route::get('/{id}/class/{cid}/edit', 'GradeController@getGradeClassEdit')->name('grade.class.edit');
        Route::post('/{id}/class/{cid}/edit', 'GradeController@postGradeClassEdit');

        Route::get('/{id}/class/{cid}/view', 'GradeController@getGradeClassView')->name('grade.class.details.view');

        Route::delete('/{id}/class/{cid}/delete', 'GradeController@getGradeClassDelete')->name('grade.class.delete');

        Route::get('/classes', 'GradeController@getGradeClasses')->middleware('ajax')->name('grade.classes.search');
    });
});
