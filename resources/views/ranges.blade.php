<x-layout>
  <x-slot:title>
    Color Range
  </x-slot>

  <div class="container-fluid mt-4 px-4">
    <h1>Calculate a Range of Colors</h1>

    <div class="row mt-4">
      <div class="col">
        <span>Reference Color</span>
        <div class="w-75 h-75 mt-2" style="background-color: <%= @the_color_as_hex %>"></div>
      </div>
      <div class="col">
        <form method="POST" action="/set_color_hex">
          @csrf
          <label class="form-label">Color HEX</label>
          <div class="row">
            <div class="col">
              <input type="text" name="the_color_hex" class="form-control" value="#AB34CD">
            </div>
          </div>
          <input type="submit" value="Enter" class="btn btn-primary mt-3"
        </form>
      </div>

      <div class="col">
        <form method="POST" action="/set_color_rgb">
          @csrf
          <label class="form-label">Color RGB</label>
          <div class="row">
            <div class="col">
              <input type="text" name="the_color_r" class="form-control" value="R">
            </div>
            <div class="col">
              <input type="text" name="the_color_g" class="form-control" value="G">
            </div>
            <div class="col">
              <input type="text" name="the_color_b" class="form-control" value="B">
            </div>
          </div>
          <input type="submit" value="Enter" class="btn btn-primary mt-3">
        </form>
      </div>

      <div class="col">
        <form method="POST" action="/set_color_hsl">
          <label class="form-label">Color HSL</label>
          <div class="row">
            <div class="col">
              <input type="text" name="the_color_h" class="form-control" value="H">
            </div>
            <div class="col">
              <input type="text" name="the_color_s" class="form-control" value="S">
            </div>
            <div class="col">
              <input type="text" name="the_color_l" class="form-control" value="L">
            </div>
          </div>
          <input type="submit" value="Enter" class="btn btn-primary mt-3">
        </form>
      </div>
    </div>
  </div>
</x-layout>
