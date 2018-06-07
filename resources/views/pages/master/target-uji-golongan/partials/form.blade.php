<form action="{{ route('cms_master_target_uji_golongan_store') }}" method="POST" id="form__master_target_uji_golongan" enctype="multipart/form-data" @submit.prevent>
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
										<label>Nama Ilmiah</label>
										<div class="field__icon">
											<input v-model="models.nama_ilmiah" name="nama_ilmiah" type="text" id="nama_ilmiah" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_ilmiah"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Daftar Sample</label>
										<div class="field__icon">
											<select name="kelompok_sample_id" class="form-control" id="kelompok_sample_id" v-model="sample_selector">
												<option v-for="list_sample in list_sample" :value="list_sample.id">@{{ list_sample.nama_kelompok }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--kelompok_sample_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Kode HS</label>
										<div class="field__icon">
											<select name="kode_hs_id" class="form-control" id="kode_hs_id" v-model="kode_hs_selector">
												<option v-for="list_kode_hs in list_kode_hs" :value="list_kode_hs.id">@{{ list_kode_hs.kode_hs }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--kode_hs_id"></div>
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
