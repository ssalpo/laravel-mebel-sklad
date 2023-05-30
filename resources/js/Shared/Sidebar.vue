<template>
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <h1 class="navbar-brand navbar-brand-autodark d-none d-sm-inline-flex" style="font-size: 18px">
                <IconBuilding :size="28" class="me-2" stroke-width="2"/>
                Мебель 777
            </h1>

            <div class="navbar-nav flex-row d-lg-none">
                <div class="nav-item me-3">
                    <Link :href="route('orders.index')" class="btn btn-icon btn-outline-light px-2">
                        <IconListDetails :size="18" class="me-1" stroke-width="1.7"/>
                        Продажи
                    </Link>
                </div>
                <div class="nav-item">
                    <Link :href="route('orders.create')" class="btn btn-icon btn-success">
                        <IconShoppingCartPlus :size="18" stroke-width="1.7"/>
                    </Link>
                </div>
            </div>

            <div class="navbar-collapse collapse" id="sidebar-menu" style="">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('dashboard.index')"
                            :class="{active: $page.component.startsWith('Dashboard')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <IconChartHistogram :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Аналитика
                            </span>
                        </Link>
                    </li>

                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('orders.index')"
                            :class="{active: $page.component.startsWith('Orders')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconListDetails :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Продажи
                            </span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link
                            class="nav-link"
                            :href="route('storehouse-balance')"
                            :class="{active: $page.component.startsWith('StorehouseBalance')}"
                        >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconCalculator :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Остатки на складе
                            </span>
                        </Link>
                    </li>
                    <li class="nav-item" :class="{active: this.$page.component.startsWith('NomenclatureArrivals')}">
                        <Link class="nav-link" :href="route('nomenclature-arrivals.index')">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconBuildingStore :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Приход на склад
                            </span>
                        </Link>
                    </li>
                    <li class="nav-item" :class="{active: directoriesIsActive}">
                        <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="true">
                              <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconList :size="24" stroke-width="1.5"/>
                              </span>

                            <span class="nav-link-title">
                                Справочники
                              </span>
                        </a>

                        <div class="dropdown-menu" :class="{show: directoriesIsActive}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <Link class="dropdown-item"
                                          :class="{active: $page.component.startsWith('Nomenclatures')}"
                                          :href="route('nomenclatures.index')">
                                        Товары
                                    </Link>
                                    <Link class="dropdown-item"
                                          :class="{active: $page.component.startsWith('Suppliers')}"
                                          :href="route('suppliers.index')">
                                        Поставщики
                                    </Link>
                                    <Link class="dropdown-item"
                                          :class="{active: $page.component.startsWith('Regions')}"
                                          :href="route('regions.index')">
                                        Регионы
                                    </Link>
                                    <Link class="dropdown-item"
                                          :class="{active: $page.component.startsWith('Users')}"
                                          :href="route('users.index')">
                                        Пользователи
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item d-inline-flex d-sm-none">
                        <a href="#" @click.prevent="logout" class="nav-link">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconLogin :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Выйти
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</template>

<script>
import {
    IconShoppingCartPlus,
    IconCirclePlus,
    IconLogin,
    IconBuilding,
    IconChartHistogram,
    IconListDetails,
    IconCalculator,
    IconBuildingStore,
    IconList,
    IconBusinessplan,
    IconFilter,
} from "@tabler/icons-vue"
import UserDropdown from "./UserDropdown.vue"
import {Link} from "@inertiajs/inertia-vue3"
import {queryParams} from "../functions";

export default {
    components: {
        IconShoppingCartPlus,
        IconFilter,
        Link,
        UserDropdown,
        IconCirclePlus,
        IconLogin,
        IconBuilding,
        IconList,
        IconChartHistogram,
        IconListDetails,
        IconCalculator,
        IconBuildingStore,
        IconBusinessplan,
    },
    computed: {
        directoriesIsActive() {
            return this.$page.component.startsWith('Suppliers') ||
                this.$page.component.startsWith('Users') ||
                this.$page.component.startsWith('Nomenclatures') ||
                this.$page.component.startsWith('Regions');
        },
        storehouseIsActive() {
            return this.$page.component.startsWith('NomenclatureArrivals');
        }
    },
    methods: {
        queryParams,
        logout() {
            this.$inertia.delete(route('logout'))
        }
    }
}
</script>
