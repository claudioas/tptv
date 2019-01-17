<!DOCTYPE html>
<html>

<head>
	<script>
		let base_url = '<?php echo base_url() ?>';
	</script>
	<title>Home</title>
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
															<v-toolbar-title>Recibir Referencia</v-toolbar-title>
														</v-toolbar>
										        <v-card-text>
															<v-list three-line>
											          <template v-for="(item, index) in lista">
											            <v-subheader
											              v-if="item.header"
											              :key="item.header"
											            >
											              {{ item.header }}
											            </v-subheader>
											            <v-divider
											              v-else-if="item.divider"
											              :inset="item.inset"
											              :key="index"
											            ></v-divider>
											            <v-list-tile
											              v-else
											              :key="item.ref_referencia"
											              avatar
											              @click=""
											            >
											              <!-- <v-list-tile-avatar>
											                <img :src="item.avatar">{{item.ref_id}}
											              </v-list-tile-avatar> -->
											              <v-list-tile-content>
											                <v-list-tile-title v-html="`#${item.ref_id}) Ref <b>${item.ref_referencia}</b>`"></v-list-tile-title>
											                <v-list-tile-sub-title v-html="`<b>OT: ${item.ref_ot}</b> - Cant-Env: ${item.ref_cantidadEnvase} - Cant. x Env: ${item.ref_cantidadxEnvase}`"></v-list-tile-sub-title>
											              </v-list-tile-content>
											            </v-list-tile>
											          </template>
													</v-list>
					</v-autocomplete>
					<v-text-field v-model="txt_referencia" label="Referencia" required v-on:keyup.13="recibirReferencia()"></v-text-field>
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="primary" @click="recibirReferencia">Recibir</v-btn>
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
	</div>

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
	<script src="https://www.gstatic.com/firebasejs/5.5.3/firebase.js"></script>
	<script src="<?php echo base_url() ?>js/vue-custom-element.js"></script>
	<script src="<?php echo base_url() ?>js/bodega/bodega_j.js"></script>
</body>

</html>
