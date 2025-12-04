<script setup>
import WebLayout from "../layouts/WebLayout.vue";
import PageHeader from "../components/PageHeader.vue";
import { MountainSnow, Camera, Car, Trees, Mountain, Wind, Bath, Bike, MapPin, Clock } from "lucide-vue-next";

const activities = [
  {
    id: 'serak-praded',
    title: 'Šerák, Praděd, ...',
    icon: Mountain,
    distance: '18 km',
    time: '28 min',
    image: '/img/activities/serak-praded.jpg', // Placeholder - user will provide
    description: 'Ani v zimním období nepřijdete zkrátka – milovníci bílé stopy se mohou přímo z Ostružné vydat na několik udržovaných běžeckých tratí. Vydat se dovezu například na Kraličky sněžník, na Praděd, Paprsek nebo na Šerák.'
  },
  {
    id: 'zatopene-lomy',
    title: 'Zatopené lomy',
    icon: Camera,
    distance: '12 km',
    time: '18 min',
    image: '/img/activities/zatopene-lomy.jpg', // Placeholder
    description: 'Nedaleko se totiž nachází více než desítka zatopených lomů, jejichž křišťálově čistá voda vám dovolí dohlédnout do neuvěřitelných hloubek. U Vápence najdete lomy Arcibiskupský, Barčák, Vycpálek či Žulový vrch, u obce Žulová můžete navštívit lomy Ferstr, Starost a Vaněk, v okolí Černé Vody zase lom Rampa a lom Rokliny a když se vydáte do Vidnavy, překvapí vás lomy Kaolinka a Stachlovice. V obci Uhelná můžete navštívit lom Pelnář.'
  },
  {
    id: 'minikary-ramzova',
    title: 'Minikáry Ramzová',
    icon: Car,
    distance: '2 km',
    time: '5 min',
    image: '/img/activities/minikary.jpg', // Placeholder
    description: 'Milovníky rychlosti jistě osloví horské minikáry v nedalské Ramzové. Pozemní výtah dlouhý 350 metrů vás vyveze na vrchol kopce, odkud se sjedete dolů po dráze měřící 850 metrů. Rychlost jakou se ze svahu pustíte je jen na vás, ale nebojte se – vše je naprosto bezpečné a vhodné i pro děti.'
  },
  {
    id: 'zoo-faunapark',
    title: 'ZOO Faunapark',
    icon: Trees,
    distance: '35 km',
    time: '40 min',
    image: '/img/activities/zoo.jpg', // Placeholder
    description: 'Máte rádi zvířata? Nedaleko Ostružné, v Lázních Lipová se můžete zblízka seznámit s exotickými zvířaty v malé rodinné ZOO Faunapark. Můžete zde zažít nabízí kontakt s exotickými zvířaty a poznat jejich život mnohem lépe, než ve velkých zoologických zahradách.'
  },
  {
    id: 'jonas-park',
    title: 'Ski areál Jonas Park',
    icon: MountainSnow,
    distance: '1 km',
    time: '5 min',
    image: '/img/activities/jonas-park.jpg', // Placeholder
    description: 'Přímo v katastru Ostružné se nachází ski areál Jonas Park, nabízející více než 2,5 km sjezdových tratí, 3 vleky a pás. Spoustu zábavy ve snowparku si užijí nejen lyžaři a snowboardisté, ale i milovníci snowtubingu. V Jonas parku si přijdou na své i malí lyžaři, kteří si mají k dispozici lyžařskou školku i s dětským vlekem a dokonce i kolotoč.'
  },
  {
    id: 'dlouhe-strane',
    title: 'Dlouhé stráně',
    icon: Wind,
    distance: '25 km',
    time: '35 min',
    image: '/img/activities/dlouhe-strane.jpg', // Placeholder
    description: 'Milovníky technických pozoruhodností jistě osloví přečerpávací vodní elektrárna Dlouhé stráně. Jedná o třetí největší přečerpávací vodní elektrárnu na světě. Návíc jde o třetí největší přečerpávací vodní elektrárnu na světě. Většina technického zařízení, kam se lze podívat v rámci prohlídky, se nachází pod zemí, takže na povrchu uvidíte pouze nádhernou hladinu nádrže, majestátně trůnící na vrcholu hory.'
  },
  {
    id: 'paprsek-smrk',
    title: 'Paprsek a Smrk',
    icon: Bike,
    distance: '15 km',
    time: '20 min',
    image: '/img/activities/paprsek-smrk.jpg', // Placeholder
    description: 'Na své si v okolí Ostružné přijdou i milovníci cyklistických a turistických tras. Přímo v Ostružné začíná 16 kilometrová trasa z Ostružné přes Paprsek a Smrk do Ramzové nebo kratší 10 kilometrová trasa Ostružná, Petříkov, Ramzová. Pokud by to bylo málo, můžete vyrazit na 35 kilometrovou trasu z Ostružné přes Červenohorské sedlo, Praděd do Karlovy studánky.'
  },
  {
    id: 'termalni-lazne',
    title: 'Termální lázně V. Losiny',
    icon: Bath,
    distance: '25 km',
    time: '30 min',
    image: '/img/activities/termalni-lazne.jpg', // Placeholder
    description: 'Pokud máte rádi teplo a venku je zrovna počasí pod psa, určitě oceníte termální lázně ve Velkých Losinách. Tento termální park, vzdálený pouhých 25 km od Ostružné, 9 vnitřních a venkovních bazénů, doplněných dvěma tobogány, kryo komorou a 4 saunami. Uvnitř se nachází termálním bazénem, relaxační masáže a wellness.'
  }
];
</script>

<template>
  <WebLayout>
    <PageHeader 
      badge="Aktivity & okolí"
      title="Co dělat v Ostružné a okolí?"
      subtitle="Nádherné malebná krajina Jeseníků učarovala již mnoha generacím turistů. Důvodů proč navštívit Jeseníky, nebo zde strávit nezapomenutelnou dovolenou je mnoho."
      image="/img/hero2.webp"
    />

    <!-- Introduction -->
    <section class="bg-white py-16">
      <div class="container mx-auto px-6">
        <div class="mx-auto max-w-4xl text-center">
          <p class="text-lg leading-relaxed text-gray-700">
            Nejen že je zde úžasná příroda a nejčistší horský vzduch ve střední Evropě, ale naleznete zde také spoustu přehledně značených tras pro pěší i cykloturisty, lyžařských sjezdovek různé obtížnosti od zelených až po černé, ale i mnoho kulturních památek. Nádherná horská panoramata si vychutnáte nejen v létě či na jaře, ale i v barevném podzimním hávu či v záplavě zimního sněhu.
          </p>
        </div>
      </div>
    </section>

    <!-- Activities Grid -->
    <section class="bg-honey py-24">
      <div class="container mx-auto px-6">
        <div class="space-y-16">
          <div 
            v-for="(activity, index) in activities" 
            :key="activity.id"
            :class="[
              'grid gap-12 lg:grid-cols-12 items-center',
              index % 2 === 0 ? '' : 'lg:grid-flow-dense'
            ]"
          >
            <!-- Image -->
            <div :class="['lg:col-span-5', index % 2 === 0 ? '' : 'lg:col-start-8']">
              <div class="aspect-[4/3] overflow-hidden rounded-[3rem] bg-gray-200">
                <img
                  :src="activity.image"
                  :alt="activity.title"
                  class="h-full w-full object-cover transition-transform duration-700 hover:scale-105"
                />
              </div>
            </div>

            <!-- Content -->
            <div :class="['lg:col-span-7', index % 2 === 0 ? '' : 'lg:col-start-1 lg:row-start-1']">
              <div class="rounded-[2.5rem] bg-white p-10">
                <div class="mb-6 flex items-center gap-4">
                  <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-white">
                    <component :is="activity.icon" class="h-8 w-8" />
                  </div>
                  <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ activity.title }}</h2>
                    <div class="mt-2 flex items-center gap-4 text-sm">
                      <div class="flex items-center gap-1 text-gray-600">
                        <MapPin class="h-4 w-4 text-primary" />
                        <span>{{ activity.distance }}</span>
                      </div>
                      <div class="flex items-center gap-1 text-gold font-bold">
                        <Clock class="h-4 w-4" />
                        <span>{{ activity.time }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <p class="text-lg leading-relaxed text-gray-700">
                  {{ activity.description }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </WebLayout>
</template>