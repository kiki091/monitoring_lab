<form action="{{ route('cms_daftar_pengujian_store') }}" method="POST" id="form__daftar_pengujian" enctype="multipart/form-data" @submit.prevent>
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
										<label>Nama Target</label>
										<div class="field__icon">

											<select name="target_pengujian_id" id="target_pengujian_id" class="form-control" v-model="target_selector">
												<option :value="obj.id" v-for="obj in list_target">@{{ obj.nama_target }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--target_pengujian_id"></div>
									</div>

									<div class="new__form__field">
										<label>Kode HPH</label>
										<div class="field__icon">
											<input v-model="models.kode_hph" name="kode_hph" type="text" id="kode_hph" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--kode_hph"></div>
									</div>

									<div class="new__form__field">
										<label>Lama Uji <b>(Hari)</b></label>
										<div class="field__icon">
											<input v-model="models.lama_uji" name="lama_uji" type="number" id="lama_uji" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--lama_uji"></div>
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
