<form action="{{ route('cms_master_sample_store') }}" method="POST" id="form__master_sample" enctype="multipart/form-data" @submit.prevent>
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
										<label>Nama Sample</label>
										<div class="field__icon">
											<input v-model="models.nama_sample" name="nama_sample" type="text" id="nama_sample" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_sample"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Jenis Sample</label>
										<div class="field__icon">
											<input v-model="models.jenis_sample" name="jenis_sample" type="text" id="jenis_sample" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--jenis_sample"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Nama Komoditas</label>
										<div class="field__icon">
											<input v-model="models.nama_komoditas" name="nama_komoditas" type="text" id="nama_komoditas" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_komoditas"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Jumlah Vol</label>
										<div class="field__icon">
											<input v-model="models.jml_vol" name="jml_vol" type="number" id="jml_vol" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--jml_vol"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Satuan</label>
										<div class="field__icon">
											<select name="satuan_id" class="form-control" id="satuan_id" v-model="satuan_selector">
												<option v-for="list_satuan in list_satuan" :value="list_satuan.id">@{{ list_satuan.nama_satuan }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--satuan_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Target Pengujian</label>
										<div class="field__icon">
											<select name="target_pengujian_id" class="form-control" id="target_pengujian_id" v-model="target_selector">
												<option v-for="list_target in list_target" :value="list_target.id">@{{ list_target.nama_target_pengujian }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--target_pengujian_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Tanggal Pengambilan</label>
										<div class="field__icon">
											<input v-model="tgl_pengambilan_sample" name="tgl_pengambilan_sample" type="text" id="tgl_pengambilan_sample" class="datepick" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--tgl_pengambilan_sample"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Metode Pengambilan</label>
										<div class="field__icon">
											<input v-model="models.metode_pengambilan_sample" name="metode_pengambilan_sample" type="text" id="metode_pengambilan_sample" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--metode_pengambilan_sample"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Kondisi Sample</label>
										<ul class="to_do">
											<li>
												<div class="radio icheck-primary">
	    											<input class="checkbox__data" type="radio" v-bind:value="1" name="kondisi_sample" id="kondisi_sample_1" />
												    <label for="kondisi_sample_1">
												    	Baik
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
	    											<input class="checkbox__data" type="radio" v-bind:value="0" name="kondisi_sample" id="kondisi_sample_0" />
												    <label for="kondisi_sample_0">
												    	Buruk
												    </label>
												</div>
											</li>
										</ul>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Nama Customer / Pemilik</label>
										<div class="field__icon">
											<input v-model="models.nama_customer" name="nama_customer" type="text" id="nama_customer" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_customer"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Alamat Customer / Pemilik</label>
										<div class="field__icon">
											<textarea v-model="models.alamat" name="alamat" id="alamat" class="form-control"></textarea>
										</div>
										<div class="form--error--message--left" id="form--error--message--alamat"></div>
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
