<form action="{{ route('cms_master_upt_store') }}" method="POST" id="form__master_upt" enctype="multipart/form-data" @submit.prevent>
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
										<label>Nama Upt</label>
										<div class="field__icon">
											<input v-model="models.nama_upt" name="nama_upt" type="text" id="nama_upt" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--nama_upt"></div>
									</div>

									<div class="new__form__field">
										<label>Kelas Upt</label>
										<div class="field__icon">
											<input v-model="models.kelas_upt" name="kelas_upt" type="text" id="kelas_upt" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--kelas_upt"></div>
									</div>

									<div class="new__form__field">
										<label>Nama Laboratorium</label>
										<div class="field__icon">
											<select class="form-control" id="lab_id" name="lab_id" v-model="lab_selector">
												<option :selected="lab_selector == obj.id" v-for="obj in list_lab" :value="obj.id">@{{ obj.nama_laboratorium }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--lab_id"></div>
									</div>

									<div class="new__form__field">
										<label>Jenis Pelabuhan</label>
										<div class="field__icon">
											<select class="form-control" id="jns_pelabuhan" name="jns_pelabuhan" v-model="pelabuhan_selector">
												<option :selected="pelabuhan_selector == obj_pelabuhan.id" v-for="obj_pelabuhan in list_pelabuhan" :value="obj_pelabuhan.id">@{{ obj_pelabuhan.name }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--jns_pelabuhan"></div>
									</div>

									<div class="new__form__field">
										<label>Daerah</label>
										<div class="field__icon">
											<select class="form-control" id="daerah_id" name="daerah_id" v-model="daerah_selector">
												<option :selected="daerah_selector == obj_daerah.id" v-for="obj_daerah in list_daerah" :value="obj_daerah.id">@{{ obj_daerah.nama_daerah }}</option>
											</select>
										</div>
										<div class="form--error--message--left" id="form--error--message--daerah_id"></div>
									</div>

									<div class="new__form__field">
										<label>Alamat</label>
										<div class="field__icon">
											<textarea class="form-control" name="alamat" id="alamat" v-model="models.alamat"></textarea>
										</div>
										<div class="form--error--message--left" id="form--error--message--alamat"></div>
									</div>

									<div class="new__form__field">
										<label>Nomer Telpon</label>
										<div class="field__icon">
											<input v-model="models.no_tlp" name="no_tlp" type="text" id="no_tlp" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--no_tlp"></div>
									</div>

									<div class="new__form__field">
										<label>Nomer Fax</label>
										<div class="field__icon">
											<input v-model="models.no_fax" name="no_fax" type="text" id="no_fax" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--no_fax"></div>
									</div>

									<div class="new__form__field">
										<label>Email</label>
										<div class="field__icon">
											<input v-model="models.email" name="email" type="text" id="email" class="form-control" placeholder="Enter here">
										</div>
										<div class="form--error--message--left" id="form--error--message--email"></div>
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
