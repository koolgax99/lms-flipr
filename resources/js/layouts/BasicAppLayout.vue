<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app>
            <v-list dense>
                <v-list-item link :to="{ name: 'dashboard' }">
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link :to="{ name: 'assignments.index' }">
                    <v-list-item-action>
                        <v-icon>mdi-attachment</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Assignments</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link :to="{ name: 'assignments.analysis' }">
                    <v-list-item-action>
                        <v-icon>mdi-chart-bar</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title
                            >Assignment Analysis</v-list-item-title
                        >
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link  :to="{ name: 'attendance.index' }">
                    <v-list-item-action>
                        <v-icon>mdi-calendar-multiple</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Attendance</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link :to="{ name: 'materials.index' }">
                    <v-list-item-action>
                        <v-icon>mdi-book-multiple</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Study Materials</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link :to="{ name: 'notices.index' }">
                    <v-list-item-action>
                        <v-icon>mdi-note-multiple</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Notices</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="indigo" dark>
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>Application</v-toolbar-title>
        </v-app-bar>

        <v-main>
            <v-container class="fill-height" fluid>
                <v-row>
                    <v-col xs="12" sm="12" md="12">
                        <router-view></router-view>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <v-footer color="indigo" app>
            <span class="white--text"
                >&copy; {{ new Date().getFullYear() }}</span
            >
        </v-footer>
    </v-app>
</template>

<script>
export default {
    props: {
        source: String
    },
    data: () => ({
        drawer: null
    })
};
</script>