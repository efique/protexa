<template>
  <div>
    <div class="card-header">
      <div style="display: flex; justify-content: space-between">
        <h2>Liste des Mails</h2>
        <a
          id="create_form_icon"
          href="#"
          class="btn btn-lg btn-primary"
          @click="openModal"
        >
          <i class="plus icon"></i>Créer un envoi automatique
        </a>
      </div>
    </div>
    <div style="">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Mail</th>
            <th></th>
            <th style="text-align: center">Intervale</th>
            <th style="text-align: center">Actif</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td style="width: 30%">
              <input type="text" v-model="user.email" style="width: 100%" />
            </td>
            <td style="width: 1%">
              <input type="button" value="Modifier" @click="updateMail(user)" />
            </td>
            <td v-if="user.interval == 0" style="width: 3%; text-align: center">
              1 minute
            </td>
            <td
              v-else-if="user.interval == 1"
              style="width: 3%; text-align: center"
            >
              5 minutes
            </td>
            <td
              v-else-if="user.interval == 2"
              style="width: 3%; text-align: center"
            >
              10 minutes
            </td>
            <td style="width: 5%">
              <input
                v-if="user.break == 0"
                type="button"
                value="Oui"
                @click="updateBreak(user)"
                style="width: 100%"
              />
              <input
                v-else-if="user.break == 1"
                type="button"
                value="Non"
                @click="updateBreak(user)"
                style="width: 100%"
              />
            </td>
            <td style="width: 13%">
              <input
                type="button"
                value="Supprimer"
                @click="deleteMail(user.id)"
                style="width: 100%"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- The Modal -->
    <div
      class="modal fade"
      id="create_form_modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">
              Création d'un envoi automatique
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createMail">
            <div class="modal-body">
              <div class="form-group">
                <label>Mail</label>
                <input
                  v-model="email"
                  type="email"
                  name="email"
                  placeholder="Mail"
                  class="form-control"
                />
              </div>
              <div class="form-group">
                <label>Intervale</label>
                <select
                  v-model="interval"
                  name="interval"
                  id="interval"
                  class="form-control"
                >
                  <option value="0">1 minute</option>
                  <option value="1">5 minutes</option>
                  <option value="2">10 minutes</option>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Créer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      users: [],
      index: 1,
      email: "",
      interval: "",
    };
  },

  created() {
    this.getMails();
  },

  methods: {
    getMails() {
      axios.get("/email").then((res) => {
        this.users = res.data;
      });
    },

    updateBreak(user) {
      var userBreak;
      if (user.break == 0) {
        userBreak = 1;
      } else if (user.break == 1) {
        userBreak = 0;
      }
      axios
        .put("/email/" + user.id, {
          id: user.id,
          email: user.email,
          interval: user.interval,
          break: userBreak,
        })
        .then((res) => {
          window.location.reload();
        });
    },

    updateMail(user) {
      if (user.email != "") {
        axios
          .put("/email/" + user.id, {
            id: user.id,
            email: user.email,
            interval: user.interval,
            break: user.break,
          })
          .then((res) => {
            window.location.reload();
          });
      }
    },

    deleteMail(id) {
      axios.delete("/email/" + id).then((res) => {
        const userIndex = this.users.findIndex((u) => u.id === id);
        this.users.splice(userIndex, 1);
      });
    },

    openModal() {
      $("#create_form_modal").modal("show");
    },

    createMail() {
      const sendData = {
        email: this.email,
        interval: this.interval,
        break: 0,
      };
      axios
        .post("/email", sendData)
        .then((res) => {
          $("#create_form_modal").modal("hide");
          swal("Envoi automatique crée");
          setTimeout(() => {
            window.location.reload();
          }, 1500);
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>