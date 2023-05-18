<template>
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <h1 class="navbar-brand navbar-brand-autodark d-none d-sm-inline-flex" style="font-size: 18px">
                <IconBuilding :size="28" class="me-2" stroke-width="2" />
                СКЛАД ПРО 1.0
            </h1>

            <div class="navbar-nav flex-row d-lg-none">
                <div class="nav-item">
                    <Link :href="route('orders.create')" class="btn btn-success">
                        <IconCirclePlus :size="18" class="me-2" stroke-width="1.7" /> Новый заказ
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
                                Остатки
                            </span>
                        </Link>
                    </li>
                    <li class="nav-item" :class="{active: this.$page.component.startsWith('Debts')}">
                        <Link class="nav-link" :href="route('debts.index')">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconBusinessplan :size="24" stroke-width="1.5"/>
                            </span>

                            <span class="nav-link-title">
                                Долги клиентов
                            </span>
                        </Link>
                    </li>
                    <li class="nav-item" :class="{active: storehouseIsActive}">
                        <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                           data-bs-auto-close="false" role="button" aria-expanded="true">
                              <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconBuildingStore :size="24" stroke-width="1.5"/>
                              </span>

                            <span class="nav-link-title">
                              Склад
                            </span>
                        </a>

                        <div class="dropdown-menu" :class="{show: storehouseIsActive}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <Link
                                        class="dropdown-item"
                                        :class="{active: $page.component.startsWith('NomenclatureArrivals')}"
                                        :href="route('nomenclature-arrivals.index')"
                                    >
                                        Приход
                                    </Link>

                                    <Link
                                        class="dropdown-item"
                                        :class="{active: $page.component.startsWith('NomenclatureOperation') && queryParams('type') == 1}"
                                        :href="route('nomenclature-operations.index', {type: 1})"
                                    >
                                        Списание
                                    </Link>

                                    <Link
                                        class="dropdown-item"
                                        :class="{active: $page.component.startsWith('NomenclatureOperation') && queryParams('type') == 2}"
                                        :href="route('nomenclature-operations.index', {type: 2})"
                                    >
                                        Возврат
                                    </Link>

                                </div>
                            </div>
                        </div>
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
                                          :class="{active: $page.component.startsWith('Clients')}"
                                          :href="route('clients.index')">
                                        Клиенты
                                    </Link>
                                    <Link class="dropdown-item"
                                          :class="{active: $page.component.startsWith('Nomenclatures')}"
                                          :href="route('nomenclatures.index')">
                                        Товар
                                    </Link>
                                    <Link class="dropdown-item"
                                          :class="{active: $page.component.startsWith('Showcases')}"
                                          :href="route('showcases.index')">
                                        Витрины
                                    </Link>
                                    <Link class="dropdown-item"
                                          :class="{active: $page.component.startsWith('Units')}"
                                          :href="route('units.index')">
                                        Единица измерения
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
            return this.$page.component.startsWith('Showcases') ||
                this.$page.component.startsWith('Users') ||
                this.$page.component.startsWith('Nomenclatures') ||
                this.$page.component.startsWith('Clients') ||
                this.$page.component.startsWith('Units');
        },
        storehouseIsActive() {
            return this.$page.component.startsWith('NomenclatureArrivals') ||
                this.$page.component.startsWith('NomenclatureOperations');
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
