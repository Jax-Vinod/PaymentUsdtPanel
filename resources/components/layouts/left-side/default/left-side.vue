 <template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-aside sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile">
                    <profile></profile>
                </div>
                <vmenu>
                    <template v-for="item in menuitems">
                        <li class="divider mt-3 " v-if="item.title">
                            <span>{{item.name}}</span>
                        </li>
                        <vsub-menu v-if="item.child" :title="item.name" :icon="item.icon">
                            <vmenu-item v-for="child in item.child" :link="child.link" :icon="child.icon" :key="child.name">{{child.name}}</vmenu-item>
                        </vsub-menu>
                        <vmenu-item v-if="item.link" :link="item.link" :icon="item.icon">{{ item.name}}
                        </vmenu-item>
                    </template>
                </vmenu>
                <!-- / .navigation -->
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
import profile from "../left-profile/user_profile2.vue"
import menu_items from "../../../../menu.js";
import notice_menu_items from "../../../../notice_menu.js";
import admin_menu_items from "../../../../admin_menu.js";
import super_admin_menu_items from "../../../../super_admin_menu.js";
import vmenu from "./menu/vueMenu.vue";
import vsubMenu from "./menu/subMenu.vue";
import vmenuItem from "./menu/MenuItem.vue";
export default {
    name: "left-side",
    components: {
        vmenu,
        vsubMenu,
        vmenuItem,
        profile
    },
    data() {
        return {
            menuitems: menu_items
        }
    },
    beforeMount: function () {
        const user = window.localStorage.getItem('user');
        if (user != null) {
            const role = JSON.parse(user)['role'];
            if (role === undefined) {
                const type = JSON.parse(user)['type'];
                if (type === 'notice') {
                    this.menuitems = notice_menu_items;
                } else this.menuitems = menu_items;
            } else {
                this.menuitems = role === 'superadmin' ? super_admin_menu_items : admin_menu_items
            }
        }
    },
}
</script>
<style scoped lang="scss">
@import "../../css/customvariables";
.left-aside {
    width: $left_menu_width;
    background: $leftmenu_color;
    background-repeat: repeat-y;
}

.navigation {
    padding: 0;
}

.divider {
    margin-top: 10px;
    list-style-type: none;
    border-bottom:1px solid #ececec;
    padding-bottom: 6px;
}

.divider span {
    font-size: 15px;
    font-weight: 700;
    color: $divider-leftheader;
    margin: 20px 20px -15px 20px;
}

.sidebar {
    display: block;
    font-size: 14px;
    letter-spacing: 1px;
}

.content {
    display: block;
    width: auto;
    overflow-x: hidden;
    padding: 0 15px;
}

.badge-success {
    background-color: #22d69d;
}

.badge {
    padding: 0.60em 0.7em;
    border-radius: 0.75rem;
}
.nav_profile{
    border-bottom:1px solid #eee;
}
</style>
