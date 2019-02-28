new Vue({
	el: '#app',
	data: {
		dialog: false,
    dialog2: false,
		dialog3: false,
		correctoTransacciones: false,
    alerta: false,
		drawer: null,
    contenido_alerta: '',
		referenciaPistoleada: "",
		selected: [2],
		items2: [],
		transaccion: '',
		items: [{
				heading: 'Referencias'
			},
			{
				icon: 'add',
				text: 'Crear Referencias',
				url: 'operario/operario_c/crear_referencia'
			},
			{
				icon: 'format_list_bulleted',
				text: 'Listar Referencias',
				url: 'operario/operario_c/listar_referencia'
			},
			{
				divider: true
			},
			{
				heading: 'Transacciones'
			},
			{
				icon: 'add',
				text: 'Crear Transacción',
				url: 'operario/operario_c/crear_transaccion'
			},
			{
				icon: 'format_list_bulleted',
				text: 'Listar Transacción',
				url: 'operario/operario_c/listar_transaccion'
			},
			{
				divider: true
			},
			{
				icon: 'exit_to_app',
				text: 'Cerrar Sesion',
				url: ''
			},
		]
	},
	props: {
		source: String
	},
	created() {
		this.cargaReferenciasls(),
		this.consultaTransaccion()
	},
	methods: {
		validaReferencia: function() {
			let repetida = false;
			if (this.referenciaPistoleada != '') {
				if (this.items2.length > 0) {
					for (var i = 0; i < this.items2.length; i++) {
						if (this.referenciaPistoleada.toUpperCase() == this.items2[i]['Referencia'].toUpperCase()) {
						// if (this.referenciaPistoleada == this.items2[i]['Referencia'].toUpperCase()) {
							repetida = true;
              this.alerta = true;
              this.contenido_alerta = `ya ingresaste esta referencia: ${this.referenciaPistoleada.toUpperCase()}`
              this.referenciaPistoleada = ''
							break;
						}
					}
					if (!repetida) {
						let datos = {
							referenciaPistoleada: this.referenciaPistoleada
						}
						this.$http.post(base_url + 'operario/operario_c/validaReferencia', datos, {
							emulateJSON: true
						}).then(response => {
							if (response.body.length > 0) {
								this.items2.push(response.body[0]);
								let i = JSON.stringify(this.items2);
								localStorage.setItem('rs', i)
								this.referenciaPistoleada = '';
							} else {
								this.dialog2 = true
								this.referenciaPistoleada = ''
							}
						}, response => {
							console.log('error validaReferencia http post');
						});
					}
				} else {
					let datos = {
						referenciaPistoleada: this.referenciaPistoleada
					}
					this.$http.post(base_url + 'operario/operario_c/validaReferencia', datos, {
						emulateJSON: true
					}).then(response => {
						if (response.body.length > 0) {
							this.items2.push(response.body[0]);
							let i = JSON.stringify(this.items2);
							localStorage.setItem('rs', i)
							this.referenciaPistoleada = '';
						} else {
							this.dialog2 = true
							this.referenciaPistoleada = ''
						}
					}, response => {
						console.log('error validaReferencia http post');
					});
				}

			} else {
				this.dialog = true
			}
		},
		redireccionar: function(i){
		  // if (i === '') {
		    // window.location.href = base_url
		  // } else {
		    window.location.href = base_url+i
		  // }
		},
		toggle(index) {
			const i = this.selected.indexOf(index)
			if (i > -1) {
				this.selected.splice(i, 1)
			} else {
				this.selected.push(index)
			}
		},
		cargaReferenciasls: function() {
			let ref_localstorage = localStorage.getItem('rs');
			ref_localstorage = JSON.parse(ref_localstorage);
			if (ref_localstorage != null) {
				for (var i = 0; i < ref_localstorage.length; i++) {
					this.items2.push(ref_localstorage[i]);
				}
			}
		},
		consultaTransaccion: function() {
			this.$http.post(base_url + 'operario/operario_c/consultaTransaccion', {
				emulateJSON: true
			}).then(response => {
				this.transaccion = response.body;
			}, response => {
				console.log('error consultaTransaccion http post');
			});
		},
		ingresaTransaccion: function() {
			let ref_localstorage = localStorage.getItem('rs');
			ref_localstorage = JSON.parse(ref_localstorage);
			ref_localstorage.unshift(this.transaccion);
			let datos = {referenciasTransaccion: ref_localstorage}
			this.$http.post(base_url + 'operario/operario_c/ingresarTransaccion', datos, {
				emulateJSON: true
			}).then(response => {
				console.log(response.body);
				if (response.body) {
					this.correctoTransacciones = true;
				}else{
					alert("error al ingresar la transacción");
				}
			}, response => {
				console.log('error validaReferencia http post');
			});
		},
		cancelarTransaccion: function() {
			localStorage.removeItem('rs');
			this.items2 = []
		}

	} //fin methods
})
