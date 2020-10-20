<div class="form__fields row d-flex flex-column">
    <div class="form__field col-6 mb-3">
        <label for="form-code">Code</label>
        <input type="text"
               class="form-control @error('code') is-invalid @enderror"
               id="form-code"
               name="code"
               value="{{ old('code', $post->code) }}"
               placeholder=""
               required=""
        >
        <div class="invalid-feedback">
            Code is required.
        </div>

        @error('code')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form__field col-6 mb-3">
        <label for="form-name">Post Name</label>
        <input type="text"
               class="form-control @error('name') is-invalid @enderror"
               id="form-name"
               name="name"
               value="{{ old('name', $post->name) }}"
               required=""
        >

        <div class="invalid-feedback">
            Post Name is required.
        </div>

        @error('name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form__field col-6 mb-3">
        <label for="form-description">Description</label>
        <input type="text"
               class="form-control @error('description') is-invalid @enderror"
               id="form-description"
               name="description"
               value="{{ old('description', $post->description) }}"
               required=""
        >

        <div class="invalid-feedback">
            Post Description is required.
        </div>

        @error('description')
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
                  placeholder="Post content here"
                  required="">{{ old('text', $post->text) }}</textarea>

        <div class="invalid-feedback">
            Post Text is required.
        </div>

        @error('text')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form__field col-6 mb-3">
        <label for="form-tags">Tags</label>
        <input type="text"
               class="form-control"
               id="form-tags"
               name="tags"
               placeholder="tag1, tag2"
               value="{{ old('tags', $post->tags->pluck('name')->implode(', ')) }}"
        >
    </div>

    <div class="form__field form-check mb-2">
        <input class="form__checkbox"
               id="form-checkbox"
               type="checkbox"
               name="published"
               @if(old('published', $post->published)) checked @endif
        >
        <label class="form-check-label" for="form-checkbox">
            Published
        </label>
    </div>
</div>
