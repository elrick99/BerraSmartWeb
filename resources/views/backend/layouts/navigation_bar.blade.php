<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                                <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>

            </span>

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category-alt"></i>
                <div data-i18n="Categorie">Users</div>
            </a>

            <ul class="menu-sub">
<!--                <li class="menu-item">-->
<!--                    <a href="" class="menu-link">-->
<!--                        <div data-i18n="Enregistrement">Enregistrement</div>-->
<!--                    </a>-->
<!--                </li>-->
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Liste Driver</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Liste Client</div>
                    </a>
                </li>

            </ul>
        </li>


        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Categorie">Configurations</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('ville.index')}}" class="menu-link">
                        <div data-i18n="Liste">Ville</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Communes</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Type Document</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Marque Vehicule</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Type Vehicule</div>
                    </a>
                </li>



            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div data-i18n="Categorie">Code</div>
            </a>

            <ul class="menu-sub">
                {{--                <li class="menu-item">--}}
                {{--                    <a href="{{ route('produits.create') }}" class="menu-link">--}}
                {{--                        <div data-i18n="Enregistrement">Enregistrement</div>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Liste Code Restant</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Liste Code Vendu</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dollar-circle "></i>
                <div data-i18n="ModePaiement">Mode de Paiement</div>
            </a>

            <ul class="menu-sub">
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('mode_paiements.create') }}" class="menu-link">--}}
{{--                        <div data-i18n="Enregistrement">Enregistrement</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Liste Mode Paiement</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-transfer "></i>
                <div data-i18n="ModePaiement">Transactions</div>
            </a>

            <ul class="menu-sub">
                {{--                <li class="menu-item">--}}
                {{--                    <a href="{{ route('mode_paiements.create') }}" class="menu-link">--}}
                {{--                        <div data-i18n="Enregistrement">Enregistrement</div>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Liste Transactions</div>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Messages -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-message"></i>
                <div data-i18n="Categorie">Message</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Liste">Liste Message Acheté</div>
                    </a>
                </li>

            </ul>
        </li>
        <!--Message-->
        <!-- Users -->
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Users</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Users">Employés</div>
            </a>
            <ul class="menu-sub"> --}}
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('employes.create') }}" class="menu-link">--}}
{{--                        <div data-i18n="Enregistrement">Enregistrement</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
                {{-- <li class="menu-item">
                    <a href="{{ route('employes') }}" class="menu-link">
                        <div data-i18n="Liste">Liste</div>
                    </a>
                </li>

            </ul>
        </li> --}}


        <!-- Statistiques -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Statistiques</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Statistique</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Error">Vente Par Annee</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Error">Vente Employé Par Annee</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Error">Vente Employé Par Mois</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="Error">Vente Par Jour Par Employe</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Settings</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bulb"></i>
                <div data-i18n="Applications">Applications (Mobile & Web)</div>
            </a>
            <ul class="menu-sub">



                 <li class="menu-item">
                    <a href="" class="menu-link">
                        <div data-i18n="add_carousel">Ajout d'image carousel</div>
                    </a>
                </li>
               {{-- <li class="menu-item">
                    <a href="{{ route('applications.img-carousel-web.index') }}" class="menu-link">
                        <div data-i18n="add_carousel">Liste image carousel</div>
                    </a>
                </li> --}}



            </ul>
        </li>


    </ul>
</aside>
