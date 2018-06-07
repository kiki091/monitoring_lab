<form action="{{ route('cms_master_metode_pengujian_store') }}" method="POST" id="form__master_metode_pengujian" enctype="multipart/form-data" @submit.prevent>
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
										<label>Metode Pengujian</label>
										<div class="field__icon">
											<input v-model="models.nama_metode_pengujian" name="nama_metode_pengujian" type="text" id="nama_metode_pengujian" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_metode_pengujian"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Target Pengujian / Golongan</label>
										<div class="field__icon">
											<select name="target_pengujian_id" id="target_pengujian_id" class="form-control" v-model="target_selector">
												<option v-for="list_target in list_target" :value="list_target.id">@{{ list_target.nama_target_pengujian }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--target_pengujian_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Laboratorium</label>
										<div class="field__icon">
											<select name="laboratorium_id" id="laboratorium_id" class="form-control" v-model="laboratorium_selector">
												<option v-for="list_laboratorium in list_laboratorium" :value="list_laboratorium.id">@{{ list_laboratorium.nama_laboratorium }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--laboratorium_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Kelompok Metode Pengujian</label>
										<div class="field__icon">
											<select name="kelompok_metode_pengujian_id" id="kelompok_metode_pengujian_id" class="form-control" v-model="kelompok_selector">
												<option v-for="list_kelompok in list_kelompok" :value="list_kelompok.id">@{{ list_kelompok.nama_kelompok }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--kelompok_metode_pengujian_id"></div>
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
