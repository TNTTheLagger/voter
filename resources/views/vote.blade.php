@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Vote for Your Favorite Color</h2>

        <form method="POST" action="{{ route('vote') }}">
            @csrf
            <div class="mb-4">
                <label for="color">Choose a color:</label>
                <select name="color" id="color" class="border border-gray-300 rounded">
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Submit Vote
            </button>
        </form>
    </div>
@endsection
