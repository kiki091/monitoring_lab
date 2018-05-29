<form action="{{ route('cms_karantina_hewan_store') }}" method="POST" id="form__karantina__hewan" enctype="multipart/form-data" @submit.prevent>
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

											<select class="form-control" v-model="sample_selector" name="kode_sample_hewan_id" id="kode_sample_hewan_id">
												<option v-for="sample in list_sample" :value="sample.id">
													@{{ sample.kode_sample }} || @{{ sample.nama_sample }}
												</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--kode_sample_hewan_id"></div>
									</div>

									<div class="new__form__field">
										<label>Dokter Hewan</label>
										<select v-model="dokter_selector" id="dokter_hewan_id" name="dokter_hewan_id">
											<option v-for="list_dokter in list_dokter" :value="list_dokter.id">
												@{{ list_dokter.nip_dokter }} || @{{ list_dokter.nama_lengkap }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--dokter_hewan_id"></div>
									</div>

									<div class="new__form__field">
										<label>Asal Kegiatan</label>
										<select v-model="kegiatan_selector" id="kegiatan_id" name="kegiatan_id">
											<option v-for="list_kegiatan in list_kegiatan" :value="list_kegiatan.id">
												@{{ list_kegiatan.nama_kegiatan }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--kegiatan_id"></div>
									</div>

									<div class="new__form__field">
										<label>Nama Pemilik</label>
										<div class="field__icon">
											<input v-model="nama_pemilik" name="nama_pemilik" type="text" id="nama_pemilik" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_pemilik"></div>
									</div>

									<div class="new__form__field">
										<label>Negara Asal</label>
										<select v-model="negara_selector" name="negara_id">
											<option v-for="list_negara in list_negara" :value="list_negara.id">
												@{{ list_negara.name }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--negara_id"></div>
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
													<input class="checkbox__data" type="radio" value="1" name="lampiran_hasil_uji" id="lampiran_hasil_uji_1" v-model="lampiran_hasil_uji" />
												    <label for="lampiran_hasil_uji_1">
												    	Ada
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="0" name="lampiran_hasil_uji" id="lampiran_hasil_uji_0"  v-model="lampiran_hasil_uji" />
												    <label for="lampiran_hasil_uji_0">
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
													<input class="checkbox__data" type="radio" value="1" name="pengiriman_sample" id="pengiriman_sample_1" v-model="pengiriman_sample" />
												    <label for="pengiriman_sample_1">
												    	Diantar Langsung
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="2" name="pengiriman_sample" id="pengiriman_sample_2"  v-model="pengiriman_sample" />
												    <label for="pengiriman_sample_2">
												    	Jasa Pos/Paket/Kurir
												    </label>
												</div>
											</li>
										</ul>
									</div>

									<div class="new__form__field">
										<label>Nama Pengirim</label>
										<div class="field__icon">
											<input v-model="nama_pengirim" name="nama_pengirim" type="text" id="nama_pengirim" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_pengirim"></div>
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
