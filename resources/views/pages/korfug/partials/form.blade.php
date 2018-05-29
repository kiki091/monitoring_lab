<form action="{{ route('cms_korfug_store') }}" method="POST" id="form__korfug" enctype="multipart/form-data" @submit.prevent>
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
							<div id="form-accordion-1" style="display: block;">
								<div class="create__form__row">

									<div class="new__form__field">
										<label>Nama Penguji/Dokter</label>
										<select name="dokter_id" class="form-control" v-model="dokter_selector" id="dokter_id">
											<option v-for="obj in list_dokter" :value="obj.id">@{{ obj.nama_lengkap }}</option>
										</select>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>NIP Koor. Fungsional</label>
										<div class="field__icon">
											<input v-model="models.nip_korfug" name="nip_korfug" type="text" id="nip_korfug" class="form-control" readonly="readonly">
										</div>
										<div class="form--error--message--left" id="form--error--message--nip_korfug"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Tanggal Usulan</label>
										<div class="field__icon">
											<input v-model="models.tgl_usulan" name="tgl_usulan" type="date" id="tgl_usulan" class="form-control">
										</div>
										<div class="form--error--message--left" id="form--error--message--tgl_usulan"></div>
									</div>
								</div>

								<div class="create__form__row">

									<div class="new__form__field">
										<label>Kedudukan</label>
										<ul class="to_do">
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="Penyelia" name="kedudukan" id="kedudukan_0" v-model="models.kedudukan" />
												    <label for="kedudukan_0">
												    	Penyelia
												    </label>
												</div>
											</li>
											<li>
												<div class="radio icheck-primary">
													<input class="checkbox__data" type="radio" value="Analis" name="kedudukan" id="kedudukan_2" v-model="models.kedudukan" />
												    <label for="kedudukan_2">
												    	Analis
												    </label>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Rincian Permohonan</label>
									</div>
									<table class="table">
										<thead>
											<th>Kode Sample</th>
											<th>Target Uji/Gol</th>
											<th>Target HPH/HPHK</th>
											<th>Nama Penguji</th>
											<th>Metode Pengujian</th>
											<th>Laboratorium</th>
											<th>Jenis Sample</th>
										</thead>
										<tbody>
											<tr>
												<td>@{{ detail_data.kode_sample }}</td>
												<td>@{{ detail_data.target_pengujian }}</td>
												<td>@{{ detail_data.target_hph }}</td>
												<td>@{{ detail_data.nama_dokter }}</td>
												<td>@{{ detail_data.metode_pengujian }}</td>
												<td>@{{ detail_data.laboratorium }}</td>
												<td>@{{ detail_data.jenis_sample }}</td>
											</tr>
										</tbody>
									</table>
									<div class="new__form__field">
										<a class="" :href="'{{ route('cms_korfug_print','type=permintaan&permohonan_id=') }}'+models.karantina_tumbuhan_id" >Cetak Permohonan</a>
									</div>
								</div>
								<hr/>
								<div class="create__form__row" v-if="korfug_data.length !== 0">
									<div class="new__form__field">
										<label>Rincian Tugas</label>
									</div>
									<table class="table">
										<thead>
											<th>#</th>
											<th>Tanggal Usulan</th>
											<th>Nama Dokter</th>
											<th>NIP Korfug</th>
											<th>Kedudukan</th>
											<th>Option</th>
										</thead>
										<tbody>
											<template v-for="(obj_korfug, idx) in korfug_data">
												<tr v-for="(obj, obj_idx) in obj_korfug">
													<td>@{{ obj_idx+1 }}</td>
													<td>@{{ obj.tgl_usulan }}</td>
													<td>@{{ obj.dokter }}</td>
													<td>@{{ obj.nip_korfug }}</td>
													<td>@{{ obj.kedudukan }}</td>
													<td>
														<a href="#" @click="deleteData(obj.id)">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
											</template>
										</tbody>
									</table>
									<div class="new__form__field">
										<a class="" :href="'{{ route('cms_korfug_print','type=usulan&permohonan_id=') }}'+models.karantina_tumbuhan_id" >Cetak Usulan</a>
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
						<div>
						
						</div>
						<div class="new__form__btn">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<input v-model="models.karantina_tumbuhan_id" type="hidden" name="karantina_tumbuhan_id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
