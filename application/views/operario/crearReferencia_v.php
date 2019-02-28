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
												<v-toolbar-title>Crear Referencia</v-toolbar-title>
											</v-toolbar>
							        <v-card-text>

												<v-autocomplete
													box
													color="blue-grey lighten-1"
													label="Orden de Trabajo"
													item-text="name"
													item-value="name"
													:items="candidatos"
													v-model="select"
												>
												</v-autocomplete>
												<v-text-field
							            label="Lote"
							            required
													v-model="lote"
							          ></v-text-field>
							          <v-text-field
													v-model="articulo"
							            label="Articulo"
							            required
							          ></v-text-field>
							          <v-text-field
													v-model="um"
							            label="Unidad de Medida"
							            required
							          ></v-text-field>
							          <v-text-field
													v-model="referencia"
							            label="Referencia"
							            required
													v-on:blur="referenciaPistoleada()"
							          ></v-text-field>
							          <v-text-field
													v-model="cantxcaja"
							            label="Cantidad por Caja"
							            required
							          ></v-text-field>
												<v-text-field
													v-model="kilosxcaja"
							            label="Kilos por Caja"
							            required
							          ></v-text-field>
							        </v-card-text>
							        <v-divider class="mt-5"></v-divider>
							        <v-card-actions>
												<v-spacer></v-spacer>
							          <v-btn color="primary" @click="ingresarReferencia" :disabled="disabled == 0 ? false : true">INgresar</v-btn>
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
      v-model="errorReferencia"
      width="500"
    >
      <!-- <v-btn
        slot="activator"
        color="red lighten-2"
        dark
      >
        Click Me
      </v-btn> -->

      <v-card><v-icon dark right>block</v-icon>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Error
        </v-card-title>

        <v-card-text>
          La referencia ya existe
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            flat
            @click="errorReferencia = false"
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
	<script src="<?php echo base_url() ?>js/operario/crearReferencia_j.js"></script>
</body>

</html>
