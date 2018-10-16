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
  <v-app id="inspire">
		<v-toolbar color="blue darken-3" dark app fixed>
			<v-toolbar-title style="width: 300px" class="ml-0 pl-3">
				<span class="hidden-sm-and-down">TPT</span>
			</v-toolbar-title>
			<v-spacer></v-spacer>
		</v-toolbar>
		<v-content>
			<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Acceso</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field prepend-icon="person" name="login" label="Usuario" type="text" v-model="u"></v-text-field>
                  <v-text-field id="password" prepend-icon="lock" name="password" label="Clave" type="password" v-model="p"></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" v-on:click="login()">Ingresar</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>
<template>
  <v-layout row justify-center>

    <v-dialog
      v-model="dialog"
      max-width="290"
    >
      <v-card>
        <v-card-title class="headline">Error&nbsp;<i class="material-icons">error_outline</i></v-card-title>

        <v-card-text>
          No pudismos encontrar el usuario que ingresaste. Por favor valida usuario y clave e inténtalo nuevamente.
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            flat="flat"
            @click="dialog = false"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>
		</v-content>
		</v-app>
		</template>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
	<script src="<?php echo base_url() ?>js/index.js"></script>
</body>

</html>
