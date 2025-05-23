<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\User;

class CarDetail extends Component
{
	public $car;
    public $mainImage;
    public $phone;
    public $isSold;
    public $comments;
    public $newComment = '';
    public $rating = 0;
    public $hoverRating = 0;

    public function mount($id)
    {
        $this->car = Car::findOrFail($id);
		$this->phone = $this->car->user->phone;
		$this->isSold = $this->car->isSold;
        $this->mainImage = explode(',', $this->car->car_Image)[0] ;
    }

    public function changeMainImage($imagePath)
    {
        $this->mainImage = $imagePath;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function hoverRating($rating)
    {
        $this->hoverRating = $rating;
    }

    public function resetRating()
    {
        $this->hoverRating = $this->rating;
    }

    public function addComment()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'newComment' => 'required|string|min:10|max:500',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->car_id = $this->car->id;
        $comment->rating = $this->rating;
        $comment->comment = $this->newComment;
        $comment->save();

        $this->comments->prepend($comment->load('user'));
        $this->newComment = '';
        $this->rating = 0;
        $this->hoverRating = 0;

        session()->flash('message', 'Thank you for your review!');
    }

    public function render()
    {
        return view('livewire.car-detail');
    }
}
