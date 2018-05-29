<form action="{{ route('cms_karantina_tumbuhan_store') }}" method="POST" id="form__karantina__tumbuhan" enctype="multipart/form-data" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>@{{ form_add_title }}</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetForm">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<span class="form__group__title">General Information<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-1"><i>@include('svg-logo.ico-expand-arrow')</i></a></span>
							</div>
							<div id="form-accordion-1" style="display: block;">
								<div class="create__form__row">

									<div class="new__form__field">
										<label>Tanggal Permohonan</label>
										<div class="field__icon">
											<input v-model="models.tgl_permohonan" name="tgl_permohonan" type="date" id="tgl_permohonan" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--tgl_permohonan"></div>
									</div>

									<div class="new__form__field">
										<label>Kodefikasi Sample</label>
										<div class="field__icon">

											<select class="form-control" v-model="sample_selector" name="kodefikasi_sample" id="kodefikasi_sample">
												<option v-for="sample in list_sample" :value="sample.id">
													@{{ sample.kode_sample }} || @{{ sample.nama_sample }}
												</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--kodefikasi_sample"></div>
									</div>

									<div class="new__form__field">
										<label>Kategori Uji</label>
										<select v-model="kategori_selector" name="kategori_id">
											<option v-for="list_kategori in list_kategori" :value="list_kategori.id">
												@{{ list_kategori.nama_kategori }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--tgl_permohonan"></div>
									</div>

									<div class="new__form__field">
										<label>Asal UPT</label>
										<select v-model="upt_selector" name="upt_id">
											<option v-for="list_upt in list_upt" :value="list_upt.id">
												@{{ list_upt.kode_upt }} || @{{ list_upt.nama_upt }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--upt_id"></div>
									</div>

									<div class="new__form__field">
										<label>Dokter Hewan</label>
										<select v-model="dokter_selector" id="dokter_id" name="dokter_id">
											<option v-for="list_dokter in list_dokter" :value="list_dokter.id">
												@{{ list_dokter.nip_dokter }} || @{{ list_dokter.nama_lengkap }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--dokter_id"></div>
									</div>

									<div class="new__form__field">
										<label>Asal Kegiatan</label>
										<select v-model="dokter_selector" id="kegiatan_id" name="kegiatan_id">
											<option v-for="list_kegiatan in list_kegiatan" :value="list_kegiatan.id">
												@{{ list_kegiatan.nama_kegiatan }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--kegiatan_id"></div>
									</div>

									<div class="new__form__field">
										<label>Kode Area</label>
										<div class="field__icon">
											<input v-model="models.kode_area" name="kode_area" type="number" id="kode_area" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--kode_area"></div>
									</div>

									<div class="new__form__field">
										<label>Identitas Pemilik</label>
										<select v-model="perusahaan_selector" name="perusahaan_id">
											<option v-for="list_perusahaan in list_perusahaan" :value="list_perusahaan.id">
												@{{ list_perusahaan.nama_perusahaan }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--perusahaan_id"></div>
									</div>

									<div class="new__form__field">
										<label>Dokumen Pendukung</label>
										<input type="file" name="dokument_pendukung" >
										<div class="form--error--message--left" id="form--error--message--dokument_pendukung"></div>
									</div>

									<div class="new__form__field">
										<label>Lampiran Hasil Uji Sebelumnya</label>
										<ul class="to_do">
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="1" name="lampiran_hsl_uji" id="lampiran_hsl_uji_1" v-bind::checked="lampiran_hsl_uji == 1" />
												    <label for="lampiran_hsl_uji_1">
												    	Ada
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="0" name="lampiran_hsl_uji" id="lampiran_hsl_uji_0"  v-bind::checked="lampiran_hsl_uji == 0" />
												    <label for="lampiran_hsl_uji_0">
												    	Tidak Ada
												    </label>
												</div>
											</li>
										</ul>
									</div>

									<div class="new__form__field">
										<label>Pengiriman Sample</label>
										<ul class="to_do">
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="1" name="pengiriman_sample" id="pengiriman_sample_1" v-bind::checked="pengiriman_sample == 1" />
												    <label for="pengiriman_sample_1">
												    	Diantar Langsung
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="2" name="pengiriman_sample" id="pengiriman_sample_2"  v-bind::checked="pengiriman_sample == 2" />
												    <label for="pengiriman_sample_2">
												    	Jasa Pos/Paket/Kurir
												    </label>
												</div>
											</li>
										</ul>
									</div>

									<div class="new__form__field">
										<label>Nama Pengantar</label>
										<div class="field__icon">
											<input :value="nama_pengantar" name="nama_pengantar" type="text" id="nama_pengantar" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_pengantar"></div>
									</div>

									<div class="new__form__field">
										<label>Tanggal Terima Sample</label>
										<div class="field__icon">
											<input v-model="tgl_terima_sample" name="tgl_terima_sample" type="date" id="tgl_terima_sample" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--tgl_terima_sample"></div>
									</div>

									<div class="new__form__field">
										<label>NIP Petugas Penerima</label>
										<div class="field__icon">
											<input v-model="nip_petugas_penerima" name="nip_petugas_penerima" type="text" id="nip_petugas_penerima" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nip_petugas_penerima"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form--bot">
				<div class="create__form">
					<div class="create__form__row flex-between">
						<div></div>
						<div class="new__form__btn">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<input v-model="models.id" v-if="edit == true" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
