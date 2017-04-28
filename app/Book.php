<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
	* Relationship method
	*/
    public function author() {
		# Book belongs to Author
		# Define an inverse one-to-many relationship.
		return $this->belongsTo('App\Author');
	}

    public function tags() {

        return $this->belongsToMany('App\Tag')->withTimestamps();

    }
}
