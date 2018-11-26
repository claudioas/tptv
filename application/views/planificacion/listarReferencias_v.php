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
                  <div id="app">
                    <v-app id="inspire">
                      <div>
                        <v-toolbar flat color="white">
                          <v-toolbar-title>My CRUD</v-toolbar-title>
                          <v-divider
                            class="mx-2"
                            inset
                            vertical
                          ></v-divider>
                          <v-spacer></v-spacer>
                          <v-dialog v-model="dialog" max-width="500px">
                            <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
                            <v-card>
                              <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                              </v-card-title>

                              <v-card-text>
                                <v-container grid-list-md>
                                  <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                      <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                      <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                      <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                      <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                </v-container>
                              </v-card-text>

                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>
                        </v-toolbar>
                        <v-data-table
                          :headers="headers"
                          :items="desserts"
                          class="elevation-1"
                        >
                          <template slot="items" slot-scope="props">
                            <td>{{ props.item.name }}</td>
                            <td class="text-xs-right">{{ props.item.calories }}</td>
                            <td class="text-xs-right">{{ props.item.fat }}</td>
                            <td class="text-xs-right">{{ props.item.carbs }}</td>
                            <td class="text-xs-right">{{ props.item.protein }}</td>
                            <td class="justify-center layout px-0">
                              <v-icon
                                small
                                class="mr-2"
                                @click="editItem(props.item)"
                              >
                                edit
                              </v-icon>
                              <v-icon
                                small
                                @click="deleteItem(props.item)"
                              >
                                delete
                              </v-icon>
                            </td>
                          </template>
                          <template slot="no-data">
                            <v-btn color="primary" @click="initialize">Reset</v-btn>
                          </template>
                        </v-data-table>
                      </div>
                    </v-app>
                  </div>
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
	<script src="<?php echo base_url() ?>js/planificacion/listarReferencias_j.js"></script>
</body>

</html>
