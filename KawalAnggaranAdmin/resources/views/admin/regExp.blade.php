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

<div class="tabrec longerrectangle">
  <div class="slideshow-container">
    <div class="mySlides">
      @if($expenditurePegawai->isEmpty()  && $expenditureBj->isEmpty() && $expenditureModal->isEmpty() && $expenditureLainnya->isEmpty())
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
      <div class="wrapadd">
        <form action="{{ route('admin.regExp.storePegawai') }}" method="POST">
          @csrf
          <label class="addlabel">Fill these text field to add data at a chosen date.</label>
          <div class="form-group">
            <select id="month" name="month" required>
                @foreach ($months as $month)
                    <option value="{{ $month }}"
                        {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>
  
        <div class="form-group">
            <select id="year" name="year" required>
                @foreach ($years as $year)
                    <option value="{{ $year->year }}"
                        {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>
          <div class="form-group">
              <label for="belanja_pegawai">Belanja Pegawai:</label>
              <input type="text" id="belanja_pegawai" name="belanja_pegawai" class="textfield" value="Belanja Pegawai" readonly>
          </div>
          <div class="form-group">
              <label for="anggaran">Anggaran:</label>
              <input type="number" step="0.01" id="anggaran" name="anggaran" class="textfield" required>
          </div>
          <div class="form-group">
              <label for="realisasi">Realisasi:</label>
              <input type="number" step="0.01" id="realisasi" name="realisasi" class="textfield" required>
          </div>
          <button type="submit" class="submitbt">Add Record</button>
      </form>
      </div>
    <div>
      <form action="{{ route('admin.regExp.deletePegawai') }}" method="POST">
        @csrf
        @method('DELETE')
        <label class="deletelabel">Select the date you want to delete data</label>
        <div class="form-group">
            <select id="month" name="month" required>
                @foreach ($months as $month)
                    <option value="{{ $month }}"
                        {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select id="year" name="year" required>
                @foreach ($years as $year)
                    <option value="{{ $year->year }}"
                        {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="submitbt">Delete Records</button>
    </form>
    </div>
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
      <div class="wrapadd">
        <form action="{{ route('admin.regExp.storeBj') }}" method="POST">
          @csrf
          <label class="addlabel">Fill these text field to add data at a chosen date.</label>
          <div class="form-group">
            <select id="month" name="month" required>
                @foreach ($months as $month)
                    <option value="{{ $month }}"
                        {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>
  
        <div class="form-group">
            <select id="year" name="year" required>
                @foreach ($years as $year)
                    <option value="{{ $year->year }}"
                        {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>
          <div class="form-group">
              <label for="barang_jasa">Barang dan Jasa:</label>
              <input type="text" id="barang_jasa" name="barang_jasa" value="Belanja Barang dan Jasa"class="textfield" readonly>
          </div>
          <div class="form-group">
              <label for="anggaran">Anggaran:</label>
              <input type="number" step="0.01" id="anggaran" name="anggaran" class="textfield" required>
          </div>
          <div class="form-group">
              <label for="realisasi">Realisasi:</label>
              <input type="number" step="0.01" id="realisasi" name="realisasi" class="textfield" required>
          </div>
          <button type="submit" class="submitbt">Add Record</button>
        </form>
      </div>
    <div>
      <form action="{{ route('admin.regExp.deleteBj') }}" method="POST">
        @csrf
        @method('DELETE')
        <label class="deletelabel">Select the date you want to delete data</label>
        <div class="form-group">
            <select id="month" name="month" required>
                @foreach ($months as $month)
                    <option value="{{ $month }}"
                        {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select id="year" name="year" required>
                @foreach ($years as $year)
                    <option value="{{ $year->year }}"
                        {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="submitbt">Delete Records</button>
    </form>
    </div>
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
      <div class="wrapadd">
        <form action="{{ route('admin.regExp.storeModal') }}" method="POST">
          @csrf
          <label class="addlabel">Fill these text field to add data at a chosen date.</label>
          <div class="form-group">
            <select id="month" name="month" required>
                @foreach ($months as $month)
                    <option value="{{ $month }}"
                        {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>
  
        <div class="form-group">
            <select id="year" name="year" required>
                @foreach ($years as $year)
                    <option value="{{ $year->year }}"
                        {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>
          <div class="form-group">
              <label for="modal">Barang dan Jasa:</label>
              <input type="text" id="modal" name="modal" value="Belanja Modal" class="textfield" readonly>
          </div>
          <div class="form-group">
              <label for="anggaran">Anggaran:</label>
              <input type="number" step="0.01" id="anggaran" name="anggaran" class="textfield" required>
          </div>
          <div class="form-group">
              <label for="realisasi">Realisasi:</label>
              <input type="number" step="0.01" id="realisasi" name="realisasi" class="textfield" required>
          </div>
          <button type="submit" class="submitbt">Add Record</button>
      </form>
      </div>
    <div>
      <form action="{{ route('admin.regExp.deleteModal') }}" method="POST">
        @csrf
        @method('DELETE')
        <label class="deletelabel">Select the date you want to delete data</label>
        <div class="form-group">
            <select id="month" name="month" required>
                @foreach ($months as $month)
                    <option value="{{ $month }}"
                        {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select id="year" name="year" required>
                @foreach ($years as $year)
                    <option value="{{ $year->year }}"
                        {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                        {{ $year->year }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="submitbt">Delete Records</button>
    </form>
    </div>
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