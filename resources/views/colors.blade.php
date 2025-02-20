 <!-- BEGIN resources/views/colors.blade.php  -->

 <x-layout>
  <x-slot:title>
    Color Range
  </x-slot>

  <div class="container-fluid mt-4 px-4">
    <h1>Calculate a Range of Colors</h1>

    <div class="row mt-4">
      <div class="col">
        <span>Reference Color</span>
        <div class="w-75 h-75 mt-2" style="background-color: {{$color_hex}}"></div>
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
          <label class="form-label">Color HSB</label>
          <div class="row">
            <div class="col">
              <input type="text" name="the_color_h" class="form-control" value="H">
            </div>
            <div class="col">
              <input type="text" name="the_color_s" class="form-control" value="S">
            </div>
            <div class="col">
              <input type="text" name="the_color_l" class="form-control" value="B">
            </div>
          </div>
          <input type="submit" value="Enter" class="btn btn-primary mt-3">
        </form>
      </div>
    </div>

  <div class="row mt-4">
    @for ($i = 0; $i < 10; $i++)
      <div class="row" >
        <div class="col">
          <div class="w-75 h-75" style="background-color: {{ $hex_range[$i] }}"></div>
        </div>
        <div class="col">
          <div> {{ $hex_range[$i] }} </div>
        </div>
        <div class="col">
          <p class="align-middle">
            @for ($j = 0; $j < 3; $j++)
            {{ $rgb_range[$i][$j] }}
              @if ($j <2)
                ,
              @endif
            @endfor
          </p>
        </div>
        <div class="col">
          <p class="align-middle">
            @for ($j = 0; $j < 3; $j++)
              {{ $hsl_range[$i][$j] }}
              @if ($j <2)
                ,
              @endif
            @endfor
          </p>
        </div>
      </div>
    @endfor
  </div>
</x-layout>
