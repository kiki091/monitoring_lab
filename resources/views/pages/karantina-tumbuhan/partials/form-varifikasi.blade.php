<form action="{{ route('cms_karantina_tumbuhan_confirm') }}" method="POST" id="form__verifikasi_permohonan" enctype="multipart/form-data" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-verifikasi-content" style="display: none; margin-top: 5%;">
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
							<div id="form-accordion-1" style="display: block;">
								<div class="create__form__row">

									<div class="new__form__field">
										<label>Persetujuan / Penolakan</label>
										<ul class="to_do">
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="0" name="status" id="status_0" v-bind::checked="models.status == 0" v-model="models.status" />
												    <label for="status_0">
												    	Ditolak
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="2" name="status" id="status_2"  v-bind::checked="models.status == 2" v-model="models.status" />
												    <label for="status_2">
												    	Diterima
												    </label>
												</div>
											</li>
										</ul>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Saran</label>
										<div class="field__icon">
											<input v-model="models.saran" name="saran" type="text" id="saran" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--saran"></div>
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
