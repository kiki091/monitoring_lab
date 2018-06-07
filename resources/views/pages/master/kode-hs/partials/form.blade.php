<form action="{{ route('cms_master_kode_hs_store') }}" method="POST" id="form__master_kode_hs" enctype="multipart/form-data" @submit.prevent>
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
										<label>Uraian Komoditas</label>
										<div class="field__icon">
											<textarea name="uraian_komoditas" class="form-control" id="uraian_komoditas" v-model="models.uraian_komoditas"></textarea>
										</div>
										<div class="form--error--message--left" id="form--error--message--uraian_komoditas"></div>
									</div>
								</div>
								
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Description (English)</label>
										<div class="field__icon">
											<textarea name="description_english" class="form-control" id="description_english" v-model="models.description_english"></textarea>
										</div>
										<div class="form--error--message--left" id="form--error--message--description_english"></div>
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
