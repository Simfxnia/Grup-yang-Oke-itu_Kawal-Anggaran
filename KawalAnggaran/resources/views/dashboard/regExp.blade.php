<script>var charttData = @json(['labels' => $labels, 'values' => $values]);</script>
@extends("layouts.main")

@section("container")
<div class="row">
  <div class="col-sm-6">
    <h6 class="centext space">Expenditure Dashboard</h6>
  </div>

  <div class="col-sm-3">
    <div>
      <form id="filterForm" method="POST" action="{{ route('exp.filter') }}">
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
      <h6>Belanja Daerah</h6>
      @if($expenditurePegawai->isEmpty())
      <h4>-</h4>
      @else
      <h3 class="num">{{ $totalExpenditure }} M</h3>
      @endif
    </div>
  </div>
</div>

<div class="row space">
  <div class="col-sm-3">
    <div class="whiterec">
      <p>Belanja Pegawai</p>
      @if($expenditurePegawai->isEmpty())
      <h4>-</h4>
      @else
      <h3 class="num">{{ $sumExpenditurePegawai }} M</h3>
      @endif
    </div>
  </div>
  <div class="col-sm-3">
    <div class="whiterec">
      <p>Belanja Barang dan Jasa</p>
      @if($expenditureBj->isEmpty())
      <h4>-</h4>
      @else
      <h3 class="num">{{ $sumExpenditureBj }} M</h3>
      @endif
    </div>
  </div>
  <div class="col-sm-3">
    <div class="whiterec">
      <p>Belanja Modal</p>
      @if($expenditureModal->isEmpty())
      <h4>-</h4>
      @else
      <h3 class="num">{{ $sumExpenditureModal }} M</h3>
      @endif
    </div>
  </div>
  <div class="col-sm-3">
    <div class="whiterec">
      <p>Belanja Lainnya</p>
      @if($expenditureLainnya->isEmpty())
      <h4>-</h4>
      @else
      <h3 class="num">{{ $sumExpenditureLainnya }} M</h3>
      @endif
    </div>
  </div>
</div>

<div class="whiterecChart tabrec space">
  <div class="chartContainer">
    <div class="chartRight">
      <canvas class="my-chart my-chartExp"></canvas>
    </div>
    <div class="chartMid">
      <div class="lineMid"></div>
    </div>
    <div class="chartLeft">
      <div class="textChartExp">
        <div class="chartText chartPAD">
          <div class="colorPAD"></div>
          <p>Belanja Pegawai</p>
        </div>
        <div class="chartText chartTKDD">
          <div class="colorTKDD"></div>
          <p>Belanja Barang dan Jasa</p>
        </div>
        <div class="chartText chartBM">
          <div class="colorBM"></div>
          <p>Belanja Modal</p>
        </div>
        <div class="chartText chartPL">
          <div class="colorPL"></div>
          <p>Belanja Lainnya</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="whiterec tabrec">
  <div class="slideshow-container">
    <div class="mySlides">
      @if($expenditurePegawai->isEmpty())
        <p>No data available for this month.</p>
      @else
      <table>
        <thead class="tableHead">
            <tr>
                <th>Belanja Daerah</th>
                <th class="tableBD">Anggaran</th>
                <th class="tableBD">Realisasi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($expenditurePegawai as $exp)
            <tr>
              <td>{{ $exp->belanja_pegawai }}</td>
              <td class="tableBD">{{ $exp->anggaran }} M</td>
              <td class="tableBD">{{ $exp->realisasi }} M</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mySlides">
      <table>
        <thead class="tableHead">
            <tr>
                <th>Belanja Barang dan Jasa</th>
                <th class="tableBBJ">Anggaran</th>
                <th class="tableBBJ">Realisasi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($expenditureBj as $exp)
            <tr>
              <td>{{ $exp->barang_jasa }}</td>
              <td class="tableBBJ">{{ $exp->anggaran }} M</td>
              <td class="tableBBJ">{{ $exp->realisasi }} M</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mySlides">
      <table>
        <thead class="tableHead">
            <tr>
                <th>Belanja Modal</th>
                <th class="tableBM">Anggaran</th>
                <th class="tableBM">Realisasi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($expenditureModal as $exp)
            <tr>
              <td>{{ $exp->modal }}</td>
              <td class="tableBM">{{ $exp->anggaran }} M</td>
              <td class="tableBM">{{ $exp->realisasi }} M</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mySlides">
      <table>
        <thead class="tableHead">
            <tr>
                <th>Belanja Lainnya</th>
                <th class="tableBL">Anggaran</th>
                <th class="tableBL">Realisasi</th>
            </tr>
        </thead>
        <tbody>
          @foreach($expenditureLainnya as $exp)
            <tr>
              <td>{{ $exp->expenditure_lainnya }}</td>
              <td class="tableBL">{{ $exp->anggaran }} M</td>
              <td class="tableBL">{{ $exp->realisasi }} M</td>
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
    <span class="dot" onclick="currentSlide(4)"></span>
  </div>
</div>
@endsection