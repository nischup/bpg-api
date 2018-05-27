<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function option()
    {
    	return $this->hasMany('App\QuestionOption', 'question_id');
    }

    public function quiz()
    {
    	return $this->belongsTo('App\QuizTopic', 'quiz_topic_id');
    }
}
