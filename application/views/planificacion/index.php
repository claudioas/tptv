<!DOCTYPE html>
<html>
<?php session_start(); ?>

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

			<span class="title ml-3 mr-5">TPT&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;<?php  echo (empty($_SESSION['per_tipo'])) ? "NO" : strtoupper(substr($_SESSION['perf_nombre'],-strlen($_SESSION['perf_nombre']),$_SESSION['perf_nombre']-2)); ?><span class="font-weight-light"></span></span>
			<v-spacer></v-spacer>
		</v-toolbar>
		<v-content>
			<v-container fluid fill-height class="grey lighten-4">
				<v-layout justify-center align-top>
					<template>
							  <v-layout justify-center>
							    <v-flex xs12 sm10 md8 lg6>
										<v-toolbar>
											<v-toolbar-title>OT Activadas</v-toolbar-title>
											<v-spacer></v-spacer>
										</v-toolbar>
									      <draggable v-model="ot_activada" :options="{group:'people'}" :move="checkMove" id="activada">
									        <transition-group class="activada">
									          <div v-for="(ote, index) in ot_activada"
									               v-bind:key="ote.ot_id"
									          >
															<v-list>
																<v-list-group
																	no-action
																>
																	<v-list-tile slot="activator">
																		<v-list-tile-content>
																			<v-list-tile-title>{{ ote.ot_tipo }} &mdash; {{ ote.ot_ot }}</v-list-tile-title>
																			<v-list-tile-sub-title>{{ ote.ot_articulo }}</v-list-tile-sub-title>
																		</v-list-tile-content>
																	</v-list-tile>

																	<v-list-tile>
																		<v-list-tile-content>
																			<v-list-tile-title>{{ ote.ot_articulo }} {{ ote.ot_lote }}</v-list-tile-title>
											              </v-list-tile-content>
											            </v-list-tile>

																</v-list-group>
															</v-list>
									          </div>
									        </transition-group>
									      </draggable>
												<v-snackbar
												v-model="snackbar"
												:color="color"
												:multi-line="mode === 'multi-line'"
												:timeout="timeout"
												:vertical="mode === 'vertical'"
												>
												{{ text }}
												<v-btn
												dark
												flat
												@click="snackbar = false"
												>
												<v-icon>done</v-icon>
											</v-btn>
										</v-snackbar>
							    </v-flex>
									<v-divider
										class="mx-3"
										inset
										vertical
									></v-divider>
									<v-flex xs12 sm10 md8 lg6>
										<v-toolbar>
											<v-toolbar-title>OT Desactivadas</v-toolbar-title>
											<v-spacer></v-spacer>
										</v-toolbar>
									      <draggable v-model="ot_desactivada" :options="{group:'people'}" :move="checkMove" id="desactivada">
									        <transition-group class="desactivada">
									          <div v-for="(ote, index) in ot_desactivada"
									               v-bind:key="ote.ot_id"
									          >
															<v-list>
																<v-list-group
																	no-action
																>
																	<v-list-tile slot="activator">
																		<v-list-tile-content>
																			<v-list-tile-title>{{ ote.ot_ot }} </v-list-tile-title>
																		</v-list-tile-content>
																	</v-list-tile>

																	<v-list-tile >
																		<v-list-tile-content>
																			<v-list-tile-title>{{ ote.ot_articulo }} {{ ote.ot_lote }}</v-list-tile-title>
											              </v-list-tile-content>
											            </v-list-tile>

																</v-list-group>
															</v-list>
									          </div>
									        </transition-group>
									      </draggable>
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
	<script src="//cdn.jsdelivr.net/npm/sortablejs@1.7.0/Sortable.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.15.0/vuedraggable.min.js"></script>
	<script src="<?php echo base_url() ?>js/vue-custom-element.js"></script>
	<script src="<?php echo base_url() ?>js/planificacion/planificacion_j.js"></script>
</body>

</html>
