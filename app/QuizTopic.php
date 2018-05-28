<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizTopic extends Model
{
    public function question()
    {
    	return $this->hasMany('App\Question', 'quiz_topic_id')->with('option');
    }
    // public function option()
    // {
    // 	return $this->hasMany('App\QuestionOption', 'question_id');
    // }
}
