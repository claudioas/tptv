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
	<meta name="google-signin-client_id" content="217271811703-ak5ss6uarm1bggup8est6gk7ih3938o4.apps.googleusercontent.com">
</head>

<body>
	<div id="app">
		<template>
		  <v-app id="inspire">
					<v-content>
						<template>
							<v-parallax hidden-lg-only
						    src="<?php echo base_url() ?>img/planificacion3.png"
								style="height:100%"
						  >
							<div id="app">
								<v-app id="inspire" style="background:none;">
									<v-content>

										<v-container fluid fill-height>
											<v-layout align-center justify-center>
												<v-flex xs12 sm8 md4 hidden-lg-only>
													<v-toolbar dark color="amber" >
												    <v-toolbar-title class="black--text ">TRANSFERENCIA PRODUCTOS TERMINADOS</v-toolbar-title>
												  </v-toolbar>
													<br>
													<v-card class="elevation-12" color="rgb(255, 255, 255, 0.9)">
														<v-toolbar dark color="amber">
															<v-toolbar-title>Indentifícate</v-toolbar-title>
															<v-spacer></v-spacer>
														</v-toolbar>
														<v-card-text>
															<v-form>
																<v-text-field prepend-icon="person" name="login" label="Usuario" type="text" v-model="u" :class="{txt_rut}" placeholder="11.222.333-4" v-on:keyup="valida_rut()"></v-text-field>
																<v-text-field prepend-icon="lock" name="password" label="Clave" id="password" type="password" v-model="p" placeholder="" v-on:keyup.13="login()"></v-text-field>
															</v-form>
														</v-card-text>
														<v-card-actions>
															<v-spacer></v-spacer>
															<v-btn color="primary" v-on:click="login()">Ingresar</v-btn>
														</v-card-actions>
													</v-card>
												</v-flex>

												<v-flex xs12 sm8 md4 hidden-xs-only hidden-sm-only hidden-md-only>
													<v-card class="elevation-12">
														<v-toolbar dark color="amber" >
															<v-toolbar-title class="black--text">TRANSFERENCIA PRODUCTOS TERMINADOS</v-toolbar-title>
														</v-toolbar>
														<br>
														<v-card-actions class="justify-center">
																<div class="g-signin2" data-onsuccess="onSignIn"></div>
														</v-card-actions>
													</v-card>
												</v-flex>

											</v-layout>
										</v-container>
									</v-content>
								</v-app>
							</div>
						</v-parallax>
							</template>
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
          Usuario y/o clave no corresponder, intenta nueamente por favor.
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
	</div>

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src="<?php echo base_url() ?>js/jquery-3.1.1.js"></script>
	<script src="<?php echo base_url() ?>js/validaRut.js"></script>
	<script src="<?php echo base_url() ?>js/index.js"></script>
	<script src="<?php echo base_url() ?>js/v.js"></script>
</body>

</html>
