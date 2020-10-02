<div class="form__fields row d-flex flex-column">
    <div class="form__field col-6 mb-3">
        <label for="form-name">New Name</label>
        <input type="text"
               class="form-control @error('name') is-invalid @enderror"
               id="form-name"
               name="name"
               value="{{ old('name', $new->name) }}"
               required=""
        >

        <div class="invalid-feedback">
            New Name is required.
        </div>

        @error('name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form__field d-flex flex-column col-12 mb-3">
        <label for="form-text">Text</label>
        <textarea name="text"
                  class="form-control @error('text') is-invalid @enderror"
                  id="form-text"
                  cols="30"
                  rows="10"
                  placeholder="New content here"
                  required="">{{ old('text', $new->text) }}</textarea>

        <div class="invalid-feedback">
            New Text is required.
        </div>

        @error('text')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
