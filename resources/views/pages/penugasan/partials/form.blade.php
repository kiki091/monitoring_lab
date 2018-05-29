<form action="{{ route('cms_penugasan_store') }}" method="POST" id="form__penugasan" enctype="multipart/form-data" @submit.prevent>
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
										<label>Daftar Permohonan</label>
										<select class="chosen-sample form-control" v-model="permohonan_selector" name="karantina_tumbuhan_id" id="karantina_tumbuhan_id">
											<option v-for="permohonan in list_permohonan" :value="permohonan.id">
												@{{ permohonan.no_permohonan }}
											</option>
										</select>
										<div class="form--error--message--left" id="form--error--message--karantina_tumbuhan_id"></div>
									</div>
								</div>

								<div class="create__form__row">
									<table class="table">
										<thead>
											<th>Target Uji</th>
											<th>Target HPH/HPHK</th>
											<th>Nama Penguji</th>
											<th>NIP</th>
											<th>Metode Pengujian</th>
											<th>Laboratorium</th>
											<th>Kodefikasi Sample</th>
											<th>Nama Sample</th>
										</thead>
										<tbody>
											<tr>
												<td>@{{ detail.target_pengujian }}</td>
												<td>@{{ detail.target_hph }}</td>
												<td>@{{ detail.nama_dokter }}</td>
												<td>@{{ detail.nip_dokter }}</td>
												<td>@{{ detail.metode_pengujian }}</td>
												<td>@{{ detail.laboratorium }}</td>
												<td>@{{ detail.kode_sample }}</td>
												<td>@{{ detail.nama_sample }}</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="create__form__row">

									<div class="new__form__field">
										<label>Kedudukan</label>
										<ul class="to_do">
											<li>
												<div class="radio icheck-primary">
	    											<input class="checkbox__data" type="radio" v-model="models.kedudukan" name="kedudukan" id="kedudukan_1" value="Penyelia" />
												    <label for="kedudukan_1">
												    	Penyelia
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
	    											<input class="checkbox__data" type="radio" v-model="models.kedudukan" name="kedudukan" id="kedudukan_2"  value="Analis"/>
												    <label for="kedudukan_2">
												    	Analis
												    </label>
												</div>
											</li>
										</ul>
										
										<div class="form--error--message--left" id="form--error--message--metode_pengambilan_sample"></div>
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
							<input v-model="detail.target_uji_id" type="hidden" name="target_uji_id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
