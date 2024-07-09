<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>var chartData = @json(['labels' => $labels, 'values' => $values]);</script>
@extends("layouts.main")

@section("container")
<div class="row">
  <div class="col-sm-6">
    <h6 class="centext space">Income Dashboard</h6>
  </div>

  <div class="col-sm-3">
    <div>
      <form id="filterForm" method="POST" action="{{ route('income.filter') }}">
        @csrf
        <div>
            <select id="month" name="month">
                @foreach ($months as $month)
                    <option value="{{ $month }}" {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                      Month | {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
          <select id="year" name="year">
            @foreach ($years as $year)
                <option value="{{ $year->year }}" {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                    Year | {{ $year->year }}
                </option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="buttonSubmit"><img src="{{ asset('img/filter.png') }}" alt="" class="filterBtn"></button>
      </form>
    </div>
  </div>
</div>

<div class="row space">
  <div class="col-sm-6">
    <h3 class="centext">Recent Data</h3>
  </div>
  <div class="col-sm-6">
    <div class="whiterec">
      <h6>Pendapatan Daerah</h6>
      @if($incomePAD->isEmpty())
      <p>No Data Available for this month.</p>
      @else
      <h3 class="num">{{ $total }} M</h3>
      @endif
    </div>
  </div>
</div>

<div class="row space">
  <div class="col-sm-4">
      <div class="whiterec">
      <p>PAD</p>
      @if($incomePAD->isEmpty())
      <h3>-</h3>
      @else
      <h3 class="num">{{ $sumIncomePAD }} M</h3>
      @endif
    </div>
  </div>
  <div class="col-sm-4">
    <div class="whiterec">
      <p>TKDD</p>
      @if($incomeTKDD->isEmpty())
      <h3>-</h3>
      @else
      <h3 class="num">{{ $TKDDValue }} M</h3>
      @endif
    </div>
  </div>
  <div class="col-sm-4">
    <div class="whiterec">
      <p>Pendapatan Lainnya</p>
      @if($incomeLainnya->isEmpty())
      <h3>-</h3>
      @else
      <h3 class="num">{{ $incomeLainnyaValue }} M</h3>
      @endif
    </div>
  </div>
</div>

<div class="whiterecChart tabrec space">
  <div class="chartContainer">
    <div class="chartRight">
      <canvas class="my-chart my-chartIncome"></canvas>
    </div>
    <div class="chartMid">
      <div class="lineMid"></div>
    </div>
    <div class="chartLeft">
      <div class="textChart">
        <div class="chartText chartPAD">
          <div class="colorPAD"></div>
          <p>PAD</p>
        </div>
        <div class="chartText chartTKDD">
          <div class="colorTKDD"></div>
          <p>TKDD</p>
        </div>
        <div class="chartText chartPL">
          <div class="colorPL"></div>
          <p>Pendapatan Lainnya</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="whiterec tabrec">
  <div class="slideshow-container">
    <div class="mySlides">
      @if($incomePAD->isEmpty())
      <p>No data available for this month.</p>
      @else
      <table>
        <thead class="tableHead">
            <tr>
                <th>Pendapatan Daerah</th>
                <th class="tableRight">Anggaran</th>
                <th class="tableRight">Realisasi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($incomePAD as $inc)
            <tr>
              <td>{{ $inc->PAD }}</td>
              <td class="tableRight">{{ $inc->anggaran }} M</td>
              <td class="tableRight">{{ $inc->realisasi }} M</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mySlides">
      <table>
        <thead class="tableHead">
            <tr>
                <th>TKDD</th>
                <th class="tableRight tableTKDD">Anggaran</th>
                <th class="tableRight tableTKDD">Realisasi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($incomeTKDD as $inc)
            <tr>
              <td>{{ $inc->TKDD }}</td>
              <td class="tableRight tableTKDD">{{ $inc->anggaran }} M</td>
              <td class="tableRight tableTKDD">{{ $inc->realisasi }} M</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mySlides">
      <table>
        <thead class="tableHead">
            <tr>
                <th>Pendapatan Lainnya</th>
                <th class="tablePL">Anggaran</th>
                <th class="tablePL">Realisasi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($incomeLainnya as $inc)
            <tr>
              <td>{{ $inc->income_lainnya }}</td>
              <td class="tablePL">{{ $inc->anggaran }} M</td>
              <td class="tablePL">{{ $inc->realisasi }} M</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
  <div class="dotplace">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>
</div>
@endsection