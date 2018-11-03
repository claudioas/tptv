<!DOCTYPE html>
<html>
<?php session_start(); ?>
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

					<span class="title ml-3 mr-5">TPT&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;<?php  echo (empty($_SESSION['per_tipo'])) ? "NO" : strtoupper(substr($_SESSION['perf_nombre'],-strlen($_SESSION['perf_nombre']),$_SESSION['perf_nombre']-2)); ?><span class="font-weight-light"></span></span>
					<v-spacer></v-spacer>
				</v-toolbar>
				<v-content>
					<v-container fluid fill-height class="grey lighten-4">
						<v-layout justify-center align-top>
							<template>
							  <v-layout justify-center>
							    <v-flex xs12 sm10 md8 lg6>
							      <v-card ref="form">
											<v-list>
							          <v-list-group
							            v-for="item in list"
							            v-model="item.ot"
													v-if="item.estado === 'activado'"
							            no-action
							          >
							            <v-list-tile slot="activator">
							              <v-list-tile-content>
							                <v-list-tile-title>{{ item.ot }} {{ item.articulo }}</v-list-tile-title>
							              </v-list-tile-content>
							            </v-list-tile>

							            <v-list-tile
							              v-for="subItem in item.items"
							            >
							              <v-list-tile-content>
															<v-list-tile-title>{{ subItem.descripcion }} {{ subItem.descripcion2 }}</v-list-tile-title>
							              </v-list-tile-content>
														<!-- <draggable element="el-collapse" :list="list" :component-data="getComponentData()">
														<el-collapse-item v-for="e in list" :title="e.title" :name="e.name" :key="e.name">
														<div>{{e.description}}</div>
													</el-collapse-item>
												</draggable> -->

							            </v-list-tile>
							          </v-list-group>
							        </v-list>
							      </v-card>
										<!-- <v-card ref="form">
											<v-list>
												<v-list-group
							            v-for="item in list"
							            v-model="item.ot"
													v-if="item.estado === 'desactivado'"
							            :key="item.title"
							            :prepend-icon="item.action"
							            no-action
							          >
							            <v-list-tile slot="activator">
							              <v-list-tile-content>
							                <v-list-tile-title>{{ item.ot }}</v-list-tile-title>
							              </v-list-tile-content>
							            </v-list-tile>

							            <v-list-tile
							              v-for="subItem in item.items"
							              :key="subItem.subtitle"
							              @click=""
							            >
							              <v-list-tile-content>
															<v-list-tile-title>{{ subItem.descripcion }} {{ subItem.descripcion2 }}</v-list-tile-title>
							              </v-list-tile-content>
							            </v-list-tile>
							          </v-list-group>
											</v-list>
										</v-card> -->
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
