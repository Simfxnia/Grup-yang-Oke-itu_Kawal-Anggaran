<script>
    var chartttData = @json(['labels' => $labels, 'values' => $values]);
</script>
@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-sm-6">
            <h6 class="centext space">Financing Dashboard</h6>
        </div>

        <div class="col-sm-3">
            <div>
                <form id="filterForm" method="POST" action="{{ route('fin.filter') }}">
                    @csrf
                    <div>
                        <select id="month" name="month">
                            @foreach ($months as $month)
                                <option value="{{ $month }}"
                                    {{ isset($selectedMonth) && $selectedMonth == $month ? 'selected' : '' }}>
                                    Month | {{ $month }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select id="year" name="year">
                            @foreach ($years as $year)
                                <option value="{{ $year->year }}"
                                    {{ isset($selectedYear) && $selectedYear == $year->year ? 'selected' : '' }}>
                                    Year | {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="buttonSubmit"><img src="{{ asset('img/filter.png') }}" alt=""
                            class="filterBtn"></button>
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
                <h6>Pembiayaan Daerah</h6>
                @if ($financingTerima->isEmpty())
                    <p>No Data Available for this month.</p>
                @else
                    <h3 class="num">{{ $totalFinancing }} M</h3>
                @endif
            </div>
        </div>
    </div>

    <div class="row space">
        <div class="col-sm-6">
            <div class="whiterec">
                <p>Penerimaan Pembiayaan Daerah</p>
                @if ($financingTerima->isEmpty())
                    <p>No Data Available for this month.</p>
                @else
                    <h3 class="num">{{ $sumFinancingTerima }} M</h3>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="whiterec">
                <p>Pengeluaran Pembiayaan Daerah</p>
                @if ($financingKeluar->isEmpty())
                    <p>No Data Available for this month.</p>
                @else
                    <h3 class="num">{{ $sumFinancingKeluar }} M</h3>
                @endif
            </div>
        </div>
    </div>

    <div class="whiterecChart tabrec space">
        <div class="chartContainer">
            <div class="chartRight">
                <canvas class="my-chart my-chartFin"></canvas>
            </div>
            <div class="chartMid">
                <div class="lineMid"></div>
            </div>
            <div class="chartLeft">
                <div class="textChartFin">
                    <div class="chartText chartPAD">
                        <div class="colorPAD"></div>
                        <p>Penerimaan Pembiayaan Daerah</p>
                    </div>
                    <div class="chartText chartTKDD">
                        <div class="colorTKDD"></div>
                        <p>Pengeluaran Pembiayaan Daerah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tabrec longerrectangle">
        <div class="slideshow-container">
            <div class="mySlides">
                @if ($financingTerima->isEmpty() && $financingKeluar->isEmpty())
                    <p>No data available for this month.</p>
                @else
                    <table>
                        <thead class="tableHead">
                            <tr>
                                <th>Penerimaan Pembiayaan Daerah</th>
                                <th class="tableRight">Anggaran</th>
                                <th class="tableRight">Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($financingTerima as $fin)
                                <tr>
                                    <td>{{ $fin->penerimaan_daerah }}</td>
                                    <td class="tableRight">{{ $fin->anggaran }} M</td>
                                    <td class="tableRight">{{ $fin->realisasi }} M</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="wrapadd">
                      <form action="{{ route('admin.regFin.storePenerimaan') }}" method="POST">
                        @php
                            $Fin = [
                                'Sisa Lebih Perhitungan Anggaran Tahun Sebelumnya',
                                'Penerimaan Kembali Pemberian Pinjaman Daerah',
                            ];
                        @endphp
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

                        @for ($i = 0; $i < 2; $i++)
                            <div>
                                <div class="form-group">
                                    <label for="penerimaan_daerah_{{ $i }}">Penerimaan Daerah:</label>
                                    <input type="text" id="penerimaan_daerah_{{ $i }}" class="textfield"
                                        name="records[{{ $i }}][penerimaan_daerah]" value="{{ $Fin[$i] }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="anggaran_{{ $i }}">Anggaran:</label>
                                    <input type="number" step="0.01" id="anggaran_{{ $i }}" class="textfield"
                                        name="records[{{ $i }}][anggaran]" required>
                                </div>
                                <div class="form-group">
                                    <label for="realisasi_{{ $i }}">Realisasi:</label>
                                    <input type="number" step="0.01" id="realisasi_{{ $i }}" class="textfield"
                                        name="records[{{ $i }}][realisasi]" required>
                                </div>
                            </div>
                        @endfor

                        <button type="submit" class="submitbt">Add Records</button>
                    </form>
                    </div>
                    <div>
                      <form action="{{ route('admin.regFin.deletePenerimaan') }}" method="POST">
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
                            <th>Pengeluaran Pembiayaan Daerah</th>
                            <th class="tablePPD">Anggaran</th>
                            <th class="tablePPD">Realisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($financingKeluar as $fin)
                            <tr>
                                <td>{{ $fin->pengeluaran_daerah }}</td>
                                <td class="tablePPD">{{ $fin->anggaran }} M</td>
                                <td class="tablePPD">{{ $fin->realisasi }} M</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="wrapadd">
                  <form action="{{ route('admin.regFin.storePengeluaran') }}" method="POST">
                    @php
                        $Fin = ['Penyertaan Modal Daerah', 'Pemberian Pinjaman Daerah',];
                    @endphp
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

                    @for ($i = 0; $i < 2; $i++)
                        <div class="form-group">
                            <label for="pengeluaran_daerah_{{ $i }}">Pengeluaran Daerah:</label>
                            <input type="text" id="pengeluaran_daerah_{{ $i }}" class="textfield"
                                name="records[{{ $i }}][pengeluaran_daerah]" value="{{ $Fin[$i] }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="anggaran_{{ $i }}">Anggaran:</label>
                            <input type="number" step="0.01" id="anggaran_{{ $i }}" class="textfield"
                                name="records[{{ $i }}][anggaran]" required>
                        </div>
                        <div class="form-group">
                            <label for="realisasi_{{ $i }}">Realisasi:</label>
                            <input type="number" step="0.01" id="realisasi_{{ $i }}" class="textfield"
                                name="records[{{ $i }}][realisasi]" required>
                        </div>
                    @endfor

                    <button type="submit" class="submitbt">Add Records</button>
                  </form>
                </div>
                <div>
                  <form action="{{ route('admin.regFin.deletePengeluaran') }}" method="POST">
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
                @endif
            </div>
        </div>
        <div class="dotplace">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
    </div>

    <div class="chart">
    </div>
@endsection
