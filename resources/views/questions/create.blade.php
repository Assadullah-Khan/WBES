@extends("layouts.app")

@section("content")
    <h1 class="text-center">
        Add new Question
    </h1>

    <container class="text-center">
        <form method="post", action="{{ route('store-question') }}">
            @csrf

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-6">
                    <textarea name="description" type="text" class="form-control" id="description" placeholder="description" rows="5">Input Questions Description here...
                    </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="options" class="col-sm-2 col-form-label">Options</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="option1" name="option1" placeholder="Option 1">
                    <input type="text" class="form-control" id="option2" name="option2" placeholder="Option 2">
                    <input type="text" class="form-control" id="option3" name="option3" placeholder="Option 3">
                    <input type="text" class="form-control" id="option4" name="option4" placeholder="Option 4">
                </div>
            </div>
            <div class="form-group row">
                <label for="answer" class="col-sm-2 col-form-label">Answer</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="answer" name="answer" placeholder="Correct Answer">
                </div>
            </div>
            <div class="form-group row">
                <label for="difficulty-level" class="col-sm-2 col-form-label">Difficulty Level</label>
                <div class="col-sm-6">
                    <select name="difficulty_level" id="difficulty_level" class="custom-select">
                        <option value="1">
                            1
                        </option>
                        <option value="2">
                            2
                        </option>
                        <option value="3">
                            3
                        </option>
                        <option value="4">
                            4
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </div>
            </div>
        </form>
    </container>

@endsection
