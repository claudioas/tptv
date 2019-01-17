<!DOCTYPE html>
<html>

<head>
	<script>
		let base_url = '<?php echo base_url() ?>';
	</script>
	<title>TPT</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>

<body>
	<div id="app">
		<template>
		  <v-app id="keep">
		    <v-navigation-drawer
		      v-model="drawer"
		      fixed
		      clipped
		      class="grey lighten-4"
		      app
		    >
		      <v-list
		        dense
		        class="grey lighten-4"
		      >
		        <template v-for="(item, i) in items">
		          <v-layout
		            v-if="item.heading"
		            :key="i"
		            row
		            align-center
		          >
		            <v-flex xs6>
		              <v-subheader v-if="item.heading">
		                {{ item.heading }}
		              </v-subheader>
		            </v-flex>
		          </v-layout>
		          <v-divider
		            v-else-if="item.divider"
		            :key="i"
		            dark
		            class="my-3"
		          ></v-divider>
		          <v-list-tile
		            v-else
		            :key="i"
		            @click="redireccionar(item.url)"
		          >
		            <v-list-tile-action>
		              <v-icon>{{ item.icon }}</v-icon>
		            </v-list-tile-action>
		            <v-list-tile-content>
		              <v-list-tile-title class="grey--text">
		                {{ item.text }}
		              </v-list-tile-title>
		            </v-list-tile-content>
		          </v-list-tile>
		        </template>
				</v-list>
				</v-navigation-drawer>
				<v-toolbar color="amber" app absolute clipped-left>
					<v-toolbar-side-icon @click.native="drawer = !drawer"></v-toolbar-side-icon>
					<span class="title ml-3 mr-5">TPT&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;<?php  echo $_SESSION['per_tipo'] ?><span class="font-weight-light"></span></span>
					<!-- <span class="title ml-3 mr-5">Transferencia de Productos Terminados&nbsp;<span class="font-weight-light"></span></span> -->
					<!-- <v-text-field
		        solo-inverted
		        flat
		        hide-details
		        label="Buscar"
		        prepend-inner-icon="search"
		      ></v-text-field> -->
					<v-spacer></v-spacer>
				</v-toolbar>
				<v-content>
					<v-container fluid fill-height class="grey lighten-4">
						<v-layout justify-center align-top>
							<template>
							  <v-layout justify-center>
							    <v-flex xs12 sm10 md8 lg6>
							      <v-card ref="form">
											<v-toolbar>
												<v-toolbar-title>Crear Transacción</v-toolbar-title>
											</v-toolbar>
							        <v-card-text>
												<v-text-field
													v-model="referenciaPistoleada"
							            outline
							            label="Referencia"
							          >
												<v-menu
												slot="append-outer"
												style="top: -12px"
												offset-y
												>
												<v-btn slot="activator" v-on:click="validaReferencia">
													<v-icon>done</v-icon>
												</v-btn>
											</v-menu>
											</v-text-field>
											<v-list two-line>
						            <template v-for="(item2, index) in items2">
						              <v-list-tile
						                :key="item2.ID"
						                avatar
						                ripple
						                @click="toggle(index)"
						              >
							                <v-list-tile-content>
																<v-list-tile-title>Lote: {{ item2.Lote }} {{ items2.Referencia }}</v-list-tile-title>
							                  <v-list-tile-sub-title class="text--primary">Cantidad Envases: {{ item2.CantEnvase }}</v-list-tile-sub-title>
							                  <v-list-tile-sub-title>Cantidad x Envases: {{ item2.CantxEnvase }}</v-list-tile-sub-title>
							                </v-list-tile-content>
							                <v-list-tile-action>
							                  <v-list-tile-action-text>{{ item2.action }}</v-list-tile-action-text>
							                </v-list-tile-action>
							              </v-list-tile>
							              <v-divider
							                v-if="index + 1 < items2.length"
							                :key="index"
							              ></v-divider>
							            </template>
	          </v-list>
							        </v-card-text>
							        <v-card-actions class="right">
												<v-btn @click="cancelarTransaccion"><v-icon>close</v-icon></v-btn>
							          <v-btn color="primary" @click="ingresaTransaccion">Enviar Transacción</v-btn>
							        </v-card-actions>
							      </v-card>
							    </v-flex>
							  </v-layout>
							</template>
						</v-layout>
					</v-container>
				</v-content>
			</v-app>
		</template>
		<template>
  <div class="text-xs-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <!-- <v-btn
        slot="activator"
        color="red lighten-2"
        dark
      >
        Click Me
      </v-btn> -->

      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Error
        </v-card-title>

        <v-card-text>
          Al menos ingresa una referencia
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            flat
            @click="dialog = false"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<template>
<div class="text-xs-center">
<v-dialog
	v-model="dialog2"
	width="500"
>
	<!-- <v-btn
		slot="activator"
		color="red lighten-2"
		dark
	>
		Click Me
	</v-btn> -->

	<v-card>
		<v-card-title
			class="headline grey lighten-2"
			primary-title
		>
			Error
		</v-card-title>

		<v-card-text>
			No existe referencia o esta asociada a otra Transacción
		</v-card-text>

		<v-divider></v-divider>

		<v-card-actions>
			<v-spacer></v-spacer>
			<v-btn
				color="primary"
				flat
				@click="dialog2 = false"
			>
				Aceptar
			</v-btn>
		</v-card-actions>
	</v-card>
</v-dialog>
</div>
</template>
<template>
<div class="text-xs-center">
<v-dialog
	v-model="alerta"
	width="500"
>

	<v-card>
		<v-card-title
			class="headline grey lighten-2"
			primary-title
		>
			Alerta
		</v-card-title>

		<v-card-text>
			{{ contenido_alerta }}
		</v-card-text>

		<v-divider></v-divider>

		<v-card-actions>
			<v-spacer></v-spacer>
			<v-btn
				color="primary"
				flat
				@click="alerta = false"
			>
				Aceptar
			</v-btn>
		</v-card-actions>
	</v-card>
</v-dialog>
</div>
</template>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
	<script src="https://www.gstatic.com/firebasejs/5.5.3/firebase.js"></script>
	<script src="<?php echo base_url() ?>js/vue-custom-element.js"></script>
	<script src="<?php echo base_url() ?>js/operario/crearTransaccion_j.js"></script>
</body>

</html>
