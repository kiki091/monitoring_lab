<div id="app">
	<div class="bg__gray">
		<div class="page-title">
			<div class="title_left">
		        <h3>@{{ form_add_title }} </h3>
		        <p>CMS MANAGEMENT SYSTEM</p>
		    </div>
		</div>
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<!-- Include form -->
    	<form action="{{ route('cms_master_permohonan_store') }}" method="POST" id="form__master_permohonan" enctype="multipart/form-data" @submit.prevent>
			<div class="main__content__form__layer" id="toggle-form-content" style="display: none;">
				<div class="create__form__wrapper">
					<div class="form--top flex-between">
						<div class="form__title">@{{ form_add_title }}</div>
						<div class="form--top__btn">
							<a href="#" class="btn__add__cancel" @click="resetForm">Cancel</a>
						</div>
					</div>

					<!-- FORM WIZARD -->
					<div class="wizard--tab form--wizard--tab" id="box">
						<ul class="wizard--tab--ul" id="menu">

							<li class="wizard--tab--li active__tab firstTab">
								<a class="wizard--tab--link" href="#permohonan">PERMOHONAN</a>
							</li>
							<li class="wizard--tab--li inactive__tab">
								<a class="wizard--tab--link" href="#daftar-sample">DAFTAR SAMPLE</a>
							</li>
							<li class="wizard--tab--li inactive__tab lastTab">
								<a class="wizard--tab--link" href="#daftar-pengujian">DAFTAR PENGUJIAN</a>
							</li>
						</ul>
					</div>
					<div class="form--mid">
						<div class="create__form content__tab active__content" id="permohonan">
							<div class="form__group__row">
								<div id="form-accordion">
									<div class="create__form__row">
										<span class="form__group__title">Status Permohonan<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-1"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
									</div>
									<div id="form-accordion-1" style="display: block;">
										<div class="create__form__row">
											<div class="new__form__field">
												<label>Jenis Karantina</label>
												<div class="field__icon">
													<select name="type_permohonan" class="new__form__input__field" id="type_permohonan" v-model="type_permohonan_selector">
														<option v-for="type_permohonan in list_type_permohonan" :value="type_permohonan.id">@{{ type_permohonan.name }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--type_permohonan"></div>
											</div>
										</div>

										<div class="create__form__row">
											<div class="new__form__field">
												<label>Kategori Uji</label>
												<div class="field__icon">
													<select name="kategori_uji_id" class="new__form__input__field" id="kategori_uji_id" v-model="kategori_selector">
														<option v-for="kategori in list_kategori" :value="kategori.id">@{{ kategori.nama_kategori }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--kategori_uji_id"></div>
											</div>
										</div>

										<div class="create__form__row">
											<div class="new__form__field">
												<label>Asal Kegiatan</label>
												<div class="field__icon">
													<select name="kegiatan_id" class="new__form__input__field" id="kegiatan_id" v-model="kegiatan_selector">
														<option v-for="kegiatan in list_kegiatan" :value="kegiatan.id">@{{ kegiatan.nama_kegiatan }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--kegiatan_id"></div>
											</div>
										</div>
										<div class="create__form__row" v-if="show_negara == true">
											<div class="new__form__field">
												<label>Asal Negara</label>
												<div class="field__icon">
													<select name="negara_id" class="new__form__input__field" id="negara_id" v-model="negara_selector">
														<option v-for="negara in list_negara" :value="negara.id">@{{ negara.nama_negara }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--negara_id"></div>
											</div>
										</div>
										<div class="create__form__row" v-if="show_upt == true">
											<div class="new__form__field">
												<label>Asal UPT / Wilker</label>
												<div class="field__icon">
													<select name="upt_id" class="new__form__input__field" id="upt_id" v-model="upt_selector">
														<option v-for="upt in list_upt" :value="upt.id">@{{ upt.nama_upt }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--upt_id"></div>
											</div>
										</div>
										<div class="create__form__row" v-if="show_daerah == true">
											<div class="new__form__field">
												<label>Asal Daerah</label>
												<div class="field__icon">
													<select name="daerah_id" class="new__form__input__field" id="daerah_id" v-model="daerah_selector">
														<option v-for="daerah in list_daerah" :value="daerah.id">@{{ daerah.nama_daerah }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--daerah_id"></div>

											</div>
										</div>

										<div class="create__form__row">
											<div class="new__form__field">
												<label>Nama Petugas</label>
												<div class="field__icon">
													<select name="dokter_hewan_id" class="new__form__input__field" id="dokter_hewan_id" v-model="dokter_selector">
														<option v-for="dokter in list_dokter" :value="dokter.id">@{{ dokter.nama_lengkap }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--dokter_hewan_id"></div>
											</div>
										</div>

										
									</div>
									<hr class="line" />

									<div class="create__form__row">
										<span class="form__group__title">Identitas Pemilik<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-2"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
									</div>

									<div id="form-accordion-2" style="display: block;">

										<div class="create__form__row" v-if="show_perusahaan == true">
											<div class="new__form__field">
												<label>Nama Perusahaan / Pemilik / Penuh / Kuasa</label>
												<div class="field__icon">
													<select name="perusahaan_id" class="new__form__input__field" id="perusahaan_id" v-model="perusahaan_selector">
														<option v-for="perusahaan in list_perusahaan" :value="perusahaan.id">@{{ perusahaan.nama_perusahaan }}</option>
													</select>
												</div>
												<div class="form--error--message--left" id="form--error--message--perusahaan_id"></div>
											</div>
										</div>
										<div class="create__form__row" v-if="show_nama_pemilik == true">
											<div class="new__form__field">
												<label>Nama Pemilik / Penuh / Kuasa</label>
												<div class="field__icon">
													<input type="text" name="nama_pemilik" class="new__form__input__field" v-model="models.nama_pemilik" id="nama_pemilik">
												</div>
												<div class="form--error--message--left" id="form--error--message--nama_pemilik"></div>
											</div>
										</div>

										<div class="create__form__row"  v-if="show_alamat_pemilik == true">
											<div class="new__form__field">
												<label>Alamat Pemilik / Penuh / Kuasa</label>
												<div class="field__icon">
													<textarea style="margin: 0px; width: 575px; height: 206px;" name="alamat_pemilik" id="alamat_pemilik" class="new__form__input__field" v-model="models.alamat_pemilik"></textarea>
												</div>
												<div class="form--error--message--left" id="form--error--message--alamat_pemilik"></div>
											</div>
										</div>
									</div>

									<hr class="line" />

									<div class="create__form__row">
										<span class="form__group__title">Dokumen Pendukung<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-3"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
									</div>

									<div id="form-accordion-3" style="display: block;">

										<div class="create__form__row">
											<div class="new__form__field">
												<label>Lampiran Hasil Uji Sebelumnya</label>
												<ul class="to_do">
													<li>
														<div class="radio icheck-primary">
			    											<input class="checkbox__data" type="radio" v-model="models.lampiran_hasil_uji" v-bind:value="1" name="lampiran_hasil_uji" id="lampiran_hasil_uji_1" />
														    <label for="lampiran_hasil_uji_1">
														    	Ada
														    </label>
														</div>
													</li>
													<li>
														<div class="radio icheck-primary">
			    											<input class="checkbox__data" type="radio" v-model="models.lampiran_hasil_uji" v-bind:value="0" name="lampiran_hasil_uji" id="lampiran_hasil_uji_0" />
														    <label for="lampiran_hasil_uji_0">
														    	Tidak Ada
														    </label>
														</div>
													</li>
												</ul>
												<div class="form--error--message--left" id="form--error--message--lampiran_hasil_uji"></div>
											</div>
										</div>
										<div class="create__form__row" v-if="models.lampiran_hasil_uji == 1">
											<div class="new__form__field">
												<label>Upload Dokumen</label>
												<div class="field__icon">
													<input v-model="dokument_pendukung" name="dokument_pendukung" type="file" id="dokument_pendukung" class="new__form__input__field">
												</div>
												<div class="form--error--message--left" id="form--error--message--dokument_pendukung"></div>
											</div>
										</div>
									</div>

									<hr class="line" />

									<div class="create__form__row">
										<span class="form__group__title">Pengiriman Sample<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-4"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
									</div>

									<div id="form-accordion-4" style="display: block;">
										<div class="create__form__row">
											<div class="new__form__field">
												<label>Cara Pengiriman Sample</label>
												<ul class="to_do">
													<li>
														<div class="radio icheck-primary">
			    											<input class="checkbox__data" type="radio" v-model="models.pengiriman_sample" v-bind:value="1" name="pengiriman_sample" id="pengiriman_sample_1" />
														    <label for="pengiriman_sample_1">
														    	Diantar Langsung
														    </label>
														</div>
													</li>
													<li>
														<div class="radio icheck-primary">
			    											<input class="checkbox__data" type="radio" v-model="models.pengiriman_sample" v-bind:value="0" name="pengiriman_sample" id="pengiriman_sample_0" />
														    <label for="pengiriman_sample_0">
														    	Jasa Pos / Paket / Kurir
														    </label>
														</div>
													</li>
												</ul>
												<div class="form--error--message--left" id="form--error--message--pengiriman_sample"></div>
											</div>
										</div>
										<div class="create__form__row">
											<div class="new__form__field">
												<label>Nama Pengantar</label>
												<div class="field__icon">
													<input v-model="models.nama_pengirim" name="nama_pengirim" type="text" id="nama_pengirim" class="new__form__input__field">
												</div>
												<div class="form--error--message--left" id="form--error--message--nama_pengirim"></div>
											</div>
										</div>
									</div>
									<hr class="line" />

									<div class="create__form__row">
										<span class="form__group__title">Penerimaan Sample<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-5"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
									</div>

									<div id="form-accordion-5" style="display: block;">
										<div class="create__form__row">
											<div class="new__form__field">
												<label>Tgl Terima Sample</label>
												<div class="field__icon">
													<input v-model="models.tgl_terima_sample" name="tgl_terima_sample" type="date" id="tgl_terima_sample" class="new__form__input__field">
												</div>
												<div class="form--error--message--left" id="form--error--message--tgl_terima_sample"></div>
											</div>
										</div>
										<div class="create__form__row">
											<div class="new__form__field">
												<label>NIP Petugas Penerima</label>
												<div class="field__icon">
													<input v-model="models.nip_petugas_penerima" name="nip_petugas_penerima" type="text" id="nip_petugas_penerima" class="new__form__input__field">
												</div>
												<div class="form--error--message--left" id="form--error--message--nip_petugas_penerima"></div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<!-- END LANGUAGE ENGLISH -->
						<!-- LANGUAGE ENGLISH -->
						<div class="create__form content__tab" id="daftar-sample">
							<div class="create__form__row">
								<span class="form__group__title">Daftar Sample<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-daftar-sample"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
							</div>
							<div id="form-accordion-daftar-sample" style="display: block;">
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Search data</label>
										<input v-model="search_by_kode_sample" name="kode_sample" type="text" id="kode_sample" class="field__search__function" placeholder="Kode sample atau nama sample">
									</div>
								</div>
								<div class="create__form__row">
									<div class="moving--check">
										<div class="moving--check--table">
											<div class="new--table__header">
												<span>SAMPLE TERPILIH</span>
											</div>
											<div class="table-test">
												<div class="bg--placeholder">
													@include('svg-logo.ico-max3')
													<p>Pilih beberapa sample yang ada di daftar</p>
												</div>
												
												<ul id="ul-checked">
												</ul>
											</div>
										</div>
										<div class="moving--check--checkbox">
											<div class="new--checkbox__header">
												<span>DAFTAR SAMPLE</span>
											</div>
											<div class="test__list__checkbox checkbox-test">
												<ul>
													<li v-for="(sample, idx) in list_sample" v-if="edit == false" :id="'list-sample['+sample.id+']'">
														<div class="form--checkbox__wrapper">
															<span class="priority"></span>
															<input type="checkbox" :id="'checkbox-en-'+idx" class="checkbox--input" name="sample_id[]" :value="sample.id">
															<label :for="'checkbox-en-'+idx" class="checkbox--label">@{{ sample.nama_sample }}</label>
															<div class="handle">
																<span class="handle-bar1"></span>
																<span class="handle-bar2"></span>
																<span class="handle-bar3"></span>
															</div>
														</div>
													</li>
													
												</ul>
											</div>
										</div>
									</div>
									<div class="form--error--message" id="form--error--message--sample_id"></div>
									
								</div>
							</div>
						</div>
						<!-- END LANGUAGE ENGLISH --><!-- LANGUAGE ENGLISH -->
						<div class="create__form content__tab" id="daftar-pengujian">
						
							<div class="create__form__row">
								<span class="form__group__title">Daftar Pengujian<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-daftar-pengujian"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
							</div>
							<div id="form-accordion-daftar-pengujian" style="display: block;">
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Target Uji Golongan</label>
										<div class="field__icon">
											<select name="target_uji_golongan_id" id="target_uji_golongan_id" class="" v-model="target_uji_golongan_selector">
												<option v-for="uji_golongan in list_target_uji_golongan" :value="uji_golongan.id">@{{ uji_golongan.nama_ilmiah ? uji_golongan.nama_ilmiah : uji_golongan.kode_target_uji }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--target_uji_golongan_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Target HPH/HPHK</label>
										<div class="field__icon">
											<select name="target_pest_id" id="target_pest_id" class="" v-model="target_pest_selector">
												<option v-for="target_pest in list_target_pest" :value="target_pest.id">@{{ target_pest.nama_target_hph }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--target_pest_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Lama Uji (Hari)</label>
										<div class="field__icon">
											<input type="text" name="lama_uji" id="lama_uji" class="new__form__input__field" v-model="pengujian.lama_uji" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--target_pest_id"></div>
									</div>
								</div>
							</div>
						</div>
						<!-- END LANGUAGE ENGLISH -->
					</div>
					<!-- END FORM WIZARD -->

					
					<div class="form--bot">
						<div class="create__form">
							<div class="create__form__row flex-between">
								<div class="new__form__btn">
								</div>
								<div class="new__form__btn">
									{{ csrf_field() }}
									<input v-model="models.id" type="hidden" name="id" value="@{{ models.id }}" v-if="edit == true">
									<button class="btn__form" type="submit" @click="storeData">Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
    	<!-- / End include form -->
    	<div class="main__content__layer">
			<div class="content__top flex-between">
				<div class="content__title">
					<h2>DAFTAR PERMOHONAN</h2>
				</div>
				<div class="content__btn">
					<a href="#" class="btn__add" id="toggle-form">Add Data</a>
		       	</div>
		    </div>
		    <div class="content__bottom">
		    	<table class="table">
		    		<thead>
		    			<tr>
			    			<th>#</th>
			    			<th>Tanggal Permohonan</th>
			    			<th>No Agenda</th>
			    			<th>No Permohonan</th>
			    			<th>Jenis Karantina</th>
			    			<th>Kategori Uji</th>
			    			<th>Tgl Terima Sample</th>
			    			<th>Nama Pengirim</th>
			    			<th>Status</th>
			    		</tr>
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td></td>
		    				<td></td>
		    				<td></td>
		    				<td></td>
		    				<td></td>
		    				<td></td>
		    				<td></td>
		    				<td></td>
		    				<td></td>
		    			</tr>
		    		</tbody>
		    </div>
		</div>
    </div>
</div>
