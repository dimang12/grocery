<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-0">
        <div class="container-fluid d-flex">
            <router-link class="navbar-brand flex-grow-0" :to="{name: 'home'}">
                <img width="200" :src="'/img/whollycity-logo.png'" />
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-grow-1" id="navbarSupportedContent">
                <div class="row w-100">
                    <div class="d-flex col-12 pr-0">
                        <form class="flex-grow-1 pl-3">
                            <div class="search-group d-flex">
                                <i class="bi-search mt-2 c-primary flex-grow-0"></i>
                                <input class="form-control border-0 flex-grow-1" type="search" placeholder="Search" aria-label="Search">
                            </div>
                        </form>
                        <div class="flex-grow-0 actions">
                            <ul class="nav">
                                <li class="nav-item">
                                    <b-dropdown
                                        id="dropdown-right"
                                        right
                                        btn-outline-secondary
                                        text=""
                                        variant="outline" class="">
                                        <template slot="button-content">
                                            <b>
                                                <i class="bi-list-ul mt-2"></i>
                                                Account
                                            </b>
                                        </template>
                                        <b-dropdown-item href="#">Your Lists</b-dropdown-item>
                                        <b-dropdown-item href="#">Account Info</b-dropdown-item>
                                        <b-dropdown-item href="#">Logout</b-dropdown-item>
                                    </b-dropdown>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
