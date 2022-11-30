@extends('layouts.admin')

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Memo</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="/memo">Memo</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Add Memo
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30" id="form-memo">
                <div class="clearfix">
                    <h4 class="text-blue h4">Edit Memo</h4>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Nama Mitra</label>
                            <input type="text" class="form-control" readonly value="{{ $ncr->nama_mitra }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>No. Memo</label>
                            <input type="text" class="form-control" readonly value="{{ $ncr->nomor_memo }}"
                                name="nomor_memo">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Nama Project</label>
                            <input type="text" class="form-control" readonly value="{{ $ncr->nama_proyek }}">
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="{{ $ncr->alamat_pengiriman }}"
                                name="alamat_pengiriman">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Tanggal Memo</label>
                            <input type="date" class="form-control" readonly
                                value="{{ $ncr->tanggal_memo->format('Y-m-d') }}" name="tanggal_memo">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Deadline Pengambilan</label>
                            <input type="date" class="form-control" placeholder="Select Date" name="deadline_pengambilan"
                                value="{{ $ncr->deadline_pengambilan->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>No FPPP</label>
                            <input type="text" class="form-control" readonly value="{{ $ncr->nomor_fppp }}">
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" onClick="Proses()">Process</button>
            </div>

            <div class="card-box mb-30 form-add-item">
                <div class="pd-20">
                    <div class="text-blue h5">List Item Memo</div>
                    <small class="mb-0">
                        list item memo yang sudah ditambahkan
                    </small>
                </div>
                <table class="table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus">Item</th>
                            <th class="table-plus">Warna</th>
                            <th class="table-plus">Bukaan</th>
                            <th class="table-plus">Panjang</th>
                            <th class="table-plus">Lebar</th>
                            <th class="table-plus">Charge</th>
                            <th class="table-plus">Return</th>
                            <th class="datatable-nosort">Act</th>
                        </tr>
                    </thead>
                    <tbody id="table-add-item">
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->kode_item }}-{{ $item->nama_item }}</td>
                                <td>{{ $item->warna }}</td>
                                <td>{{ $item->bukaan }}</td>
                                <td>{{ $item->lebar }}</td>
                                <td>{{ $item->tinggi }}</td>
                                <td>{{ $item->charge }}</td>
                                <td>{{ $item->return_barang }}</td>
                                <td>
                                    <button class="btn btn-danger" type="button" onClick="hapusForm(this)">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pd-20">
                    <button class="btn btn-primary" onClick="Finish(this)">Finish</button>
                </div>
            </div>

            <div class="pd-20 card-box mb-30 form-add-item" id="form-add-item">
                <div class="clearfix">
                    <h4 class="text-blue h4">Add Items Memo</h4>
                </div>

                @foreach ($items as $itemm)
                    <div class="row d-none">
                        <div class="col">
                            <div class="form-group">
                                <label>Tipe Item :</label>
                                <select class="form-control custom-select" name="tipe_item">
                                    <option {{ $itemm->tipe_item == 'Common' ? 'selected' : '' }} value="Common">Common
                                    </option>
                                    <option {{ $itemm->tipe_item == 'Uncommon' ? 'selected' : '' }} value="Uncommon">
                                        Uncommon</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Item :</label>
                                <select class="custom-select form-control" name="item_id">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    @foreach ($ncr->ItemNcr as $item)
                                        <option
                                            value="{{ $item->id }}-{{ $item->kode_item }}-{{ $item->nama_item }}"
                                            {{ $itemm->id == $item->id ? 'selected' : '' }}>
                                            {{ $item->kode_item }}-{{ $item->nama_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode Warna :</label>
                                <input type="text" name="warna" class="form-control" value="{{ $itemm->warna }}">
                            </div>
                            <div class="form-group">
                                <label>Bukaan :</label>
                                <select class="custom-select form-control" name="bukaan">
                                    <option value="Kiri" {{ $itemm->bukaan == 'Kiri' ? 'selected' : '' }}>Kiri</option>
                                    <option value="Kanan" {{ $itemm->bukaan == 'Kanan' ? 'selected' : '' }}>Kanan
                                    </option>
                                    <option value="Tidak Ada Bukaan"
                                        {{ $itemm->bukaan == 'Tidak Ada Bukaan' ? 'selected' : '' }}>Tidak Ada Bukaan
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Daun :</label>
                                <input type="text" name="daun" class="form-control" value="{{$itemm->daun}}">
                            </div>
                            <div class="form-group">
                                <label>Jumlah :</label>
                                <input type="number" name="jumlah" class="form-control" value="{{$itemm->jumlah}}">
                            </div>
                            <div class="form-group">
                                <label>Panjang(mm) :</label>
                                <input type="number" class="form-control" value="{{ $itemm->lebar }}" name="lebar">
                            </div>
                            <div class="form-group">
                                <label>Lebar(mm) :</label>
                                <input type="number" class="form-control" value="{{ $itemm->tinggi }}" name="tinggi">
                            </div>
                            <div class="form-group">
                                <label>Alasan :</label>
                                <textarea class="form-control" name="alasan">{{ $itemm->alasan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Charge :</label>
                                <select class="custom-select form-control" name="charge">
                                    <option value="Ya" {{ $itemm->charge == 'Ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="Tidak" {{ $itemm->charge == 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Barang dikembalikan :</label>
                                <select class="custom-select form-control" name="return">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    <option value="Ya" {{ $itemm->return_barang == 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak" {{ $itemm->return_barang == 'Tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Keterangan :</label>
                                <textarea class="form-control" name="keterangan">{{ $itemm->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tipe Item :</label>
                            <select class="form-control custom-select" name="tipe_item">
                                <option value="" readonly selected hidden>Pilih</option>
                                <option>Common</option>
                                <option>Uncommon</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item :</label>
                            <select class="custom-select form-control" name="item_id">
                                <option value="" readonly selected hidden>Pilih</option>
                                @foreach ($ncr->ItemNcr as $item)
                                    <option value="{{ $item->id }}-{{ $item->kode_item }}-{{ $item->nama_item }}">
                                        {{ $item->kode_item }}-{{ $item->nama_item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Warna :</label>
                            <input type="text" name="warna" class="form-control" value="{{ $item->warna }}">
                        </div>
                        <div class="form-group">
                            <label>Bukaan :</label>
                            <select class="custom-select form-control" name="bukaan">
                                <option value="" readonly selected hidden>Pilih</option>
                                <option value="kiri">Kiri</option>
                                <option value="kanan">Kanan</option>
                                <option value="tidak">Tidak Ada Bukaan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Daun :</label>
                            <input type="text" class="form-control" name="daun">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="jumlah">
                        </div>
                        <div class="form-group">
                            <label>Panjang(mm) :</label>
                            <input type="number" class="form-control" name="lebar">
                        </div>
                        <div class="form-group">
                            <label>Lebar(mm) :</label>
                            <input type="number" class="form-control" name="tinggi">
                        </div>
                        <div class="form-group">
                            <label>Alasan :</label>
                            <textarea class="form-control" name="alasan"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Charge :</label>
                            <select class="custom-select form-control" name="charge">
                                <option value="" readonly selected hidden>Pilih</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Barang dikembalikan :</label>
                            <select class="custom-select form-control" name="return">
                                <option value="" readonly selected hidden>Pilih</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan :</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" onClick="tambahForm(this)" id="addItem">Add Item</button>
            </div>
        </div>
    </div>
    @endsection
    @push('script')
    <script>
        let data_item = {
            nomor_memo: "{{$ncr->nomor_memo}}",
            alamat_pengiriman: "{{$ncr->alamat_pengiriman}}",
            deadline_pengambilan: '{{$ncr->deadline_pengambilan->format("Y-m-d")}}',
            tanggal_memo : '{{$ncr->tanggal_memo->format("Y-m-d")}}',
            data_item: {!!$items!!}.length > 0 ? {!!$items!!} : [],
        };
    
        function Proses() {
            document.querySelectorAll("#form-memo .form-control").forEach(function (elemen) {
                if (elemen.name == "nomor_memo") {
                    data_item.nomor_memo = elemen.value;
                } else if (elemen.name == "alamat_pengiriman") {
                    data_item.alamat_pengiriman = elemen.value;
                } else if (elemen.name == "deadline_pengambilan") {
                    data_item.deadline_pengambilan = elemen.value;
                } else if (elemen.name == "tanggal_memo") {
                    data_item.tanggal_memo = elemen.value;
                }
            });
        }
    
        function Finish (elemen) {
            if (data_item.data_item.length < 1) {
                alert("tambahkan item terlebih dahulu");
            } else {
                $(document).ready(function () {
                    $.ajax({
                        url: "/memo/" + {{$ncr->id}},
                        type: "PUT",
                        data: {
                            _token: "{{ csrf_token() }}",
                            data_item
                        },
                        success: function (response) {
                            window.location = "/memo";
                        },
                        error: function (response) {
                            console.log(response)
                        }
                    });
                });
            }
        }
    
        function hapusForm (elemen) {
            data_item.data_item.splice(elemen.parentElement.parentElement.rowIndex - 1, 1);
            document.getElementById("form-add-item").children.item(elemen.parentElement.parentElement.rowIndex).remove();
            elemen.parentElement.parentElement.remove();
        }
    
        function tambahForm (elemen) {
            elemen.previousElementSibling.classList.add("d-none");
            let input = document.querySelectorAll("#form-add-item .form-control");
            let jumlah = input.length / 12;
            let table_add_item = document.querySelector("#table-add-item");
            let baris_table_add_item = document.createElement("tr");
            let kolom_table_add_item = undefined;
            let luas = 0;
            let item = {};
            for (let i = (jumlah - 1) * 12; i < input.length; i++) {
                if (input[i].name != "item_id") {
                    item[`${input[i].name}`] = input[i].value;
                }
                if (input[i].name == "warna" || input[i].name == "bukaan" || input[i].name == "charge" || input[i].name == "return" || input[i].name == "lebar" || input[i].name == "tinggi") {
                    kolom_table_add_item = document.createElement("td");
                    kolom_table_add_item.innerHTML = input[i].value;
                    baris_table_add_item.appendChild(kolom_table_add_item);
                } else if (i == input.length - 1) {
                    kolom_table_add_item = document.createElement("td");
                    kolom_table_add_item.innerHTML = `<button class="btn btn-danger" type="button" onClick="hapusForm(this)">Hapus</button>`;
                    baris_table_add_item.appendChild(kolom_table_add_item);
                } else if (input[i].name == "item_id") {
                    kolom_table_add_item = document.createElement("td");
                    kolom_table_add_item.innerHTML = input[i].value.split("-")[1] + "-" + input[i].value.split("-")[2];
                    baris_table_add_item.appendChild(kolom_table_add_item);
                    item[`id`] = input[i].value.split("-")[0];
                }
            }
            data_item.data_item.push(item);
            table_add_item.appendChild(baris_table_add_item);
            elemen.remove();
    
            $(document).ready(function () {
                $("#form-add-item").append(`<div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tipe Item :</label>
                                <select class="form-control custom-select" name="tipe_item">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    <option value="Common">Common</option>
                                    <option value="Uncommon">Uncommon</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Item :</label>
                                <select class="custom-select form-control" name="item_id">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    @foreach ($ncr->ItemNcr as $item)
                                    <option value="{{$item->id}}-{{$item->kode_item}}-{{$item->nama_item}}">
                                        {{$item->kode_item}}-{{$item->nama_item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Warna :</label>
                                <select class="custom-select form-control" name="warna">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    <option value="Wood Finish">Wood Finish</option>
                                    <option value="Monochromatic">Monochromatic</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bukaan :</label>
                                <select class="custom-select form-control" name="bukaan">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    <option value="Kiri">Kiri</option>
                                    <option value="Kanan">Kanan</option>
                                    <option value="Tidak Ada Bukaan">Tidak Ada Bukaan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Panjang(mm) :</label>
                                <input type="number" class="form-control" name="lebar">
                            </div>
                            <div class="form-group">
                                <label>Lebar(mm) :</label>
                                <input type="number" class="form-control" name="tinggi">
                            </div>
                            <div class="form-group">
                                <label>Alasan :</label>
                                <textarea class="form-control" name="alasan"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Charge :</label>
                                <select class="custom-select form-control" name="charge">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Barang dikembalikan :</label>
                                <select class="custom-select form-control" name="return">
                                    <option value="" readonly selected hidden>Pilih</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Keterangan :</label>
                                <textarea class="form-control" name="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onClick="tambahForm(this)" id="addItem">Add Item</button>`);
            });
        }
    </script>
    @endpush